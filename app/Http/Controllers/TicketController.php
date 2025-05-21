<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Event;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\ActivityLogService;

class TicketController extends Controller
{
    protected $activityLogService;

    public function __construct(ActivityLogService $activityLogService)
    {
        $this->activityLogService = $activityLogService;
    }
    public function storeType(Request $request, Event $event)
    {
        $request->validate([
            'type' => 'required|string',
            'custom_name' => 'required_if:type,custom|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string'
        ]);

        $name = $request->type === 'custom' ? $request->custom_name : ucfirst($request->type);

        // Vérifier si ce type de ticket existe déjà pour cet événement
        if ($event->ticketTypes()->where('name', $name)->exists()) {
            return redirect()->back()->with('error', 'Ce type de ticket existe déjà pour cet événement.');
        }

        $ticketType = new TicketType([
            'name' => $name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'eventId' => $event->id
        ]);

        $ticketType->save();

        // Log de la création du type de ticket
        $this->activityLogService->log($ticketType, 'create_ticket_type', [
            'quantity' => $request->quantity
        ]);

        return redirect()->back()->with('success', 'Type de ticket ajouté avec succès.');
    }

    public function addQuantity(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        DB::beginTransaction();
        try {
            $ticketType = TicketType::findOrFail($id);
            $ticketType->quantity += $request->quantity;
            $ticketType->save();

            // Log de l'ajout de quantité
            $this->activityLogService->log($ticketType, 'add_quantity', [
                'quantity' => $request->quantity
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Quantité ajoutée avec succès');
        } catch (\Exception $e) {
            DB::rollback();
            info('Erreur lors de l\'ajout de quantité', [
                'error' => $e->getMessage(),
                'ticketType' => $id,
                'quantity' => $request->quantity
            ]);
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'ajout de la quantité');
        }
    }

    public function removeQuantity(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        DB::beginTransaction();
        try {
            $ticketType = TicketType::findOrFail($id);

            // Vérifier si la quantité à retirer ne dépasse pas la quantité disponible
            if ($request->quantity > $ticketType->quantity) {
                return redirect()->back()->with('error', 'La quantité à retirer ne peut pas être supérieure à la quantité disponible');
            }

            $ticketType->quantity -= $request->quantity;
            $ticketType->save();

            // Log du retrait de quantité
            $this->activityLogService->log($ticketType, 'remove_quantity', [
                'quantity' => $request->quantity
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Quantité retirée avec succès');
        } catch (\Exception $e) {
            DB::rollback();
            info('Erreur lors du retrait de quantité', [
                'error' => $e->getMessage(),
                'ticketType' => $id,
                'quantity' => $request->quantity
            ]);
            return redirect()->back()->with('error', 'Une erreur est survenue lors du retrait de la quantité');
        }
    }

    public function index()
    {
        // Get all events with their ticket types and basic info
        $events = Event::with(['ticketTypes' => function($query) {
            $query->withCount(['tickets' => function($q) {
                $q->where('status', '!=', 'cancelled');
            }]);
        }])->get();

        // Get tickets grouped by event with all necessary relationships
        $tickets = Ticket::with([
            'event',
            'user',
            'ticketType',
            'transaction',
            'validator'
        ])
        ->get()
        ->groupBy('event.title');

        // Prepare event statistics for all events
        $eventStats = [];
        foreach ($events as $event) {
            $eventStats[$event->title] = [
                'id' => $event->id,
                'image_url' => $event->image_url,
                'types' => $event->ticketTypes->map(function($type) {
                    return [
                        'id' => $type->id,
                        'name' => $type->name,
                        'quantity' => $type->quantity,
                        'sold' => $type->tickets_count,
                        'available' => $type->quantity - $type->tickets_count
                    ];
                })
            ];

            // Si l'événement n'a pas de tickets, ajouter un tableau vide
            if (!isset($tickets[$event->title])) {
                $tickets[$event->title] = collect();
            }
        }
            
        return view('tickets.index', compact('tickets', 'eventStats'));
    }

    public function create()
    {
        $events = Event::all();
        return view('tickets.create', compact('events'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'ticket_type_id' => 'required|exists:ticket_types,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
        ]);

        $validated['user_id'] = auth()->id();
        $ticket = Ticket::create($validated);

        return redirect()->route('tickets.show', $ticket)
            ->with('success', 'Ticket réservé avec succès.');
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    public function myTickets()
    {
        $tickets = Ticket::where('user_id', auth()->id())
            ->with(['event', 'ticketType'])
            ->orderBy('id', 'desc')
            ->paginate(10);
            
        return view('tickets.my-tickets', compact('tickets'));
    }

    public function cancel(Ticket $ticket)
    {
        if($ticket->user_id !== auth()->id()) {
            abort(403);
        }

        $ticket->status = 'cancelled';
        $ticket->save();

        return redirect()->route('tickets.my-tickets')
            ->with('success', 'Ticket annulé avec succès.');
    }
} 
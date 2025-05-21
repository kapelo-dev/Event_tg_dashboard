<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\TicketType;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketTypeController extends Controller
{
    protected $activityLogService;

    public function __construct(ActivityLogService $activityLogService)
    {
        $this->activityLogService = $activityLogService;
    }

    public function store(Request $request, $eventId)
    {
        $request->validate([
            'type' => 'required|string',
            'custom_name' => 'nullable|required_if:type,custom|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            $event = Event::findOrFail($eventId);
            
            $ticketType = new TicketType();
            $ticketType->name = $request->type === 'custom' ? $request->custom_name : ucfirst($request->type);
            $ticketType->price = $request->price;
            $ticketType->quantity = $request->quantity;
            $ticketType->description = $request->description;
            $ticketType->eventId = $eventId;
            $ticketType->save();

            // Log de la création du type de ticket
            $this->activityLogService->log($ticketType, 'create_ticket_type', [
                'quantity' => $request->quantity
            ]);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Type de ticket créé avec succès'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            info('Erreur lors de la création du type de ticket', [
                'error' => $e->getMessage(),
                'event' => $eventId,
                'request' => $request->all()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la création du type de ticket'
            ], 500);
        }
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
                'ticket_type' => $id,
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
                'ticket_type' => $id,
                'quantity' => $request->quantity
            ]);
            return redirect()->back()->with('error', 'Une erreur est survenue lors du retrait de la quantité');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\FileUploadService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Services\ActivityLogService;

class EventController extends Controller
{
    protected $fileUploadService;
    protected $activityLogService;

    public function __construct(FileUploadService $fileUploadService, ActivityLogService $activityLogService)
    {
        $this->fileUploadService = $fileUploadService;
        $this->activityLogService = $activityLogService;
    }

    public function index(Request $request)
    {
        $query = Event::with(['category', 'ticketTypes', 'ticketTypes.tickets' => function($query) {
            $query->where('status', '!=', 'cancelled');
        }]);

        // Filtre par catégorie
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $events = $query->orderBy('start_date', 'desc')->paginate(10);
        $categories = Category::where('active', 1)->get();

        // Calculer les statistiques pour chaque événement
        $events->each(function($event) {
            // Calculer la capacité totale
            $event->total_capacity = $event->ticketTypes->sum('quantity');
            
            // Calculer le nombre de tickets vendus par type
            $event->tickets_sold = $event->ticketTypes->sum(function($type) {
                return $type->tickets->count();
            });
            
            // Calculer le statut de l'événement
            $now = Carbon::now();
            $startDate = Carbon::parse($event->start_date);
            $endDate = Carbon::parse($event->end_date);
            
            // Déterminer automatiquement si c'est un événement sur plusieurs jours
            $event->is_multi_day = !$startDate->isSameDay($endDate);
            
            if ($endDate->isFuture()) {
                if ($event->tickets_sold >= $event->total_capacity) {
                    $event->status = 'Complet';
                    $event->status_color = 'red';
                } elseif ($startDate->isPast() && $endDate->isFuture()) {
                    $event->status = 'En cours';
                    $event->status_color = 'yellow';
                } else {
                    $event->status = 'À venir';
                    $event->status_color = 'green';
                }
            } else {
                $event->status = 'Terminé';
                $event->status_color = 'gray';
            }
            
            // Calculer le revenu total
            $event->total_revenue = $event->ticketTypes->sum(function($type) {
                return $type->tickets->count() * $type->price;
            });

            // Formater la période de l'événement
            if ($event->is_multi_day) {
                $event->period = $startDate->format('d/m/Y') . ' au ' . $endDate->format('d/m/Y');
                if ($event->has_specific_time) {
                    $event->period .= ' de ' . $event->start_time . ' à ' . $event->end_time;
                }
            } else {
                $event->period = $startDate->format('d/m/Y');
                if ($event->has_specific_time) {
                    $event->period .= ' de ' . $event->start_time . ' à ' . $event->end_time;
                }
            }
        });

        // Maintenir le filtre dans la pagination
        $events->appends(['category' => $request->category]);

        return view('events.index', compact('events', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('active', 1)->get();
        return view('events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            // Log initial request
            Log::info('Event creation request received', [
                'all_data' => $request->all(),
                'has_file' => $request->hasFile('image_url'),
                'files' => $request->allFiles()
            ]);

            // Préparer les données avant validation
            $data = $request->all();
            if (empty($data['end_date'])) {
                $request->merge(['end_date' => $data['start_date']]);
            }

            \Log::info('Starting event creation', ['request_data' => $data]);

            // Valider les données
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'location' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i',
                'image_url' => 'nullable|image|max:2048',
                'tickets' => 'required|array|min:1',
                'tickets.*.type' => 'required|string|in:simple,standard,vip,custom',
                'tickets.*.custom_name' => 'nullable|required_if:tickets.*.type,custom|string|max:255',
                'tickets.*.description' => 'nullable|string',
                'tickets.*.price' => 'required|numeric|min:0',
                'tickets.*.quantity' => 'required|integer|min:1',
            ]);

            \Log::info('Validation passed', $validated);

            // Gérer le téléchargement de l'image si présente
            if ($request->hasFile('image_url')) {
                \Log::info('Image file detected', [
                    'original_name' => $request->file('image_url')->getClientOriginalName(),
                    'mime_type' => $request->file('image_url')->getMimeType(),
                    'size' => $request->file('image_url')->getSize()
                ]);

                try {
                    $path = $this->fileUploadService->uploadFile($request->file('image_url'), 'event-covers');
                    \Log::info('Image uploaded successfully', [
                        'path' => $path,
                        'is_cloudinary' => str_contains($path, 'cloudinary.com')
                    ]);
                    $validated['image_url'] = $path;
                } catch (\Exception $e) {
                    \Log::error('Error uploading image', [
                        'error' => $e->getMessage(),
                        'file' => $request->file('image_url')->getClientOriginalName(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    throw $e;
                }
            } else {
                \Log::info('No image file in request');
            }

            // Créer l'événement
            $event = Event::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'category_id' => $validated['category_id'],
                'location' => $validated['location'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
                'image_url' => $validated['image_url'] ?? null,
                'is_multi_day' => $validated['start_date'] !== $validated['end_date'],
                'has_specific_time' => true,
            ]);

            \Log::info('Event created', ['event' => $event->toArray()]);

            // Créer les types de billets
            if (isset($validated['tickets']) && is_array($validated['tickets'])) {
                foreach ($validated['tickets'] as $ticketData) {
                    $ticketType = $event->ticketTypes()->create([
                        'name' => $ticketData['type'] === 'custom' ? $ticketData['custom_name'] : ucfirst($ticketData['type']),
                        'description' => $ticketData['description'] ?? null,
                        'price' => $ticketData['price'],
                        'quantity' => $ticketData['quantity'],
                        'eventId' => $event->id
                    ]);

                    // Log de la création du type de ticket
                    $this->activityLogService->log($ticketType, 'create_ticket_type', [
                        'quantity' => $ticketData['quantity']
                    ]);
                }
                \Log::info('Ticket types created for event', [
                    'event_id' => $event->id,
                    'tickets' => $validated['tickets']
                ]);
            }

            return redirect()->route('events.index')
                ->with('success', 'Événement créé avec succès.');

        } catch (\Exception $e) {
            \Log::error('Error creating event', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Une erreur est survenue lors de la création de l\'événement. Veuillez réessayer.']);
        }
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $categories = Category::where('active', 1)->get();
        return view('events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_multi_day' => 'boolean',
            'has_specific_time' => 'boolean',
            'start_time' => 'required_if:has_specific_time,true',
            'end_time' => 'required_if:has_specific_time,true|after_or_equal:start_time',
            'location' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'nullable|image|max:2048',
        ]);

        try {
            // Gérer le téléchargement de la nouvelle image si présente
            if ($request->hasFile('image_url')) {
                // Supprimer l'ancienne image si elle existe
                if ($event->image_url) {
                    $this->fileUploadService->deleteFile($event->image_url);
                }

                // Uploader la nouvelle image
                $path = $this->fileUploadService->uploadFile($request->file('image_url'), 'event-covers');
                $validated['image_url'] = $path;
            } else {
                // Garder l'ancienne image
                $validated['image_url'] = $event->image_url;
            }

            // Déterminer automatiquement si c'est un événement sur plusieurs jours
            $startDate = Carbon::parse($validated['start_date']);
            $endDate = Carbon::parse($validated['end_date']);
            $validated['is_multi_day'] = !$startDate->isSameDay($endDate);

            $event->update($validated);

            return redirect()->route('events.index')
                ->with('success', 'Événement mis à jour avec succès.');
        } catch (\Exception $e) {
            \Log::error('Error updating event', [
                'error' => $e->getMessage(),
                'event_id' => $event->id,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Une erreur est survenue lors de la mise à jour de l\'événement. Veuillez réessayer.']);
        }
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Événement supprimé avec succès.');
    }
} 
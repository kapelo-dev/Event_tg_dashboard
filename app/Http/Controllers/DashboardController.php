<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\TicketType;
use App\Models\MobileMoneyTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $currentPeriodStart = $now->copy()->subDays(30);
        $previousPeriodStart = $now->copy()->subDays(60);

        // Statistiques des événements
        $totalEvents = Event::count();
        $currentEvents = Event::where('created_at', '>=', $currentPeriodStart)->count();
        $previousEvents = Event::whereBetween('created_at', [$previousPeriodStart, $currentPeriodStart])->count();
        
        // Calcul du trend avec protection contre division par zéro
        if ($previousEvents == 0) {
            $eventsTrend = $currentEvents > 0 ? 100 : 0;
        } else {
            $eventsTrend = round((($currentEvents - $previousEvents) / $previousEvents) * 100);
        }

        // Statistiques des billets vendus
        $totalTickets = Ticket::where('status', '!=', 'cancelled')->count();
        $currentTickets = Ticket::where('createdAt', '>=', $currentPeriodStart)
            ->where('status', '!=', 'cancelled')
            ->count();
        $previousTickets = Ticket::whereBetween('createdAt', [$previousPeriodStart, $currentPeriodStart])
            ->where('status', '!=', 'cancelled')
            ->count();
        
        // Calcul du trend avec protection contre division par zéro
        if ($previousTickets == 0) {
            $ticketsTrend = $currentTickets > 0 ? 100 : 0;
        } else {
            $ticketsTrend = round((($currentTickets - $previousTickets) / $previousTickets) * 100);
        }

        // Graphique des billets vendus sur 7 jours
        $maxTickets = 1; // Pour éviter la division par zéro dans le graphique
        $ticketsChart = collect(range(6, 0))->map(function($day) use (&$maxTickets) {
            $date = Carbon::now()->subDays($day);
            $count = Ticket::whereDate('createdAt', $date)
                ->where('status', '!=', 'cancelled')
                ->count();
            $maxTickets = max($maxTickets, $count);
            return $count;
        })->values()->all();

        // Statistiques des revenus
        $totalRevenue = MobileMoneyTransaction::where('status', 'success')->sum('amount');
        $currentRevenue = MobileMoneyTransaction::where('createdAt', '>=', $currentPeriodStart)
            ->where('status', 'success')
            ->sum('amount');
        $previousRevenue = MobileMoneyTransaction::whereBetween('createdAt', [$previousPeriodStart, $currentPeriodStart])
            ->where('status', 'success')
            ->sum('amount');
        
        // Calcul du trend avec protection contre division par zéro
        if ($previousRevenue == 0) {
            $revenueTrend = $currentRevenue > 0 ? 100 : 0;
        } else {
            $revenueTrend = round((($currentRevenue - $previousRevenue) / $previousRevenue) * 100);
        }

        // Graphique des revenus sur 7 jours
        $maxRevenue = 1; // Pour éviter la division par zéro dans le graphique
        $revenueChart = collect(range(6, 0))->map(function($day) use (&$maxRevenue) {
            $date = Carbon::now()->subDays($day);
            $amount = MobileMoneyTransaction::whereDate('createdAt', $date)
                ->where('status', 'success')
                ->sum('amount');
            $maxRevenue = max($maxRevenue, $amount);
            return $amount;
        })->values()->all();

        // Statistiques des événements par catégorie
        $eventsByCategory = Event::select('category_id', DB::raw('count(*) as total'))
            ->groupBy('category_id')
            ->get();
        
        $totalEventCount = $eventsByCategory->sum('total');
        
        // Calcul des pourcentages par catégorie avec protection contre division par zéro
        $salesByRegion = $eventsByCategory->map(function($item) use ($totalEventCount) {
            $category = Category::find($item->category_id);
            return [
                'name' => $category ? $category->name : 'Non catégorisé',
                'percentage' => $totalEventCount > 0 ? round(($item->total / $totalEventCount) * 100) : 0
            ];
        })->sortByDesc('percentage')->values()->all();

        // Top événements (basé sur les ventes réelles)
        $topEvents = Event::with(['category', 'tickets', 'ticketTypes'])
            ->withCount(['tickets as tickets_sold' => function($query) {
                $query->where('status', '!=', 'cancelled');
            }])
            ->orderBy('tickets_sold', 'desc')
            ->take(5)
            ->get()
            ->map(function($event) {
                $event->total_capacity = $event->ticketTypes->sum('quantity');
                $event->min_price = $event->ticketTypes->min('price');
                $event->status = $this->getEventStatus($event);
                $event->status_color = $this->getStatusColor($event->status);
                return $event;
            });

        // Taux de conversion (billets vendus / capacité totale)
        $totalCapacity = TicketType::sum('quantity');
        $conversionRate = $totalCapacity > 0 ? round(($totalTickets / $totalCapacity) * 100, 2) : 0;
        $conversionTrend = $ticketsTrend;

        // Catégories pour le filtre
        $categories = Category::where('active', 1)->get();

        // Événements à venir et en cours
        $upcomingEvents = Event::with(['category', 'ticketTypes'])
            ->where(function($query) {
                $now = Carbon::now();
                $query->where('end_date', '>=', $now)
                    ->orWhere(function($q) use ($now) {
                        $q->where('start_date', '<=', $now)
                          ->where('end_date', '>=', $now);
                    });
            })
            ->orderBy('start_date', 'asc')
            ->get()
            ->map(function($event) {
                $event->status = $this->getEventStatus($event);
                $event->status_color = $this->getStatusColor($event->status);
                
                // Calcul des revenus en multipliant le prix par le nombre de billets vendus pour chaque type
                $event->total_revenue = $event->ticketTypes->sum(function($ticketType) {
                    return $ticketType->price * $ticketType->tickets()
                        ->where('status', '!=', 'cancelled')
                        ->count();
                });
                
                return $event;
            });

        return view('dashboard', compact(
            'totalEvents',
            'eventsTrend',
            'totalTickets',
            'ticketsTrend',
            'ticketsChart',
            'maxTickets',
            'totalRevenue',
            'revenueTrend',
            'revenueChart',
            'maxRevenue',
            'conversionRate',
            'conversionTrend',
            'topEvents',
            'salesByRegion',
            'categories',
            'upcomingEvents'
        ));
    }

    private function getEventStatus($event)
    {
        $now = Carbon::now();
        $startDate = Carbon::parse($event->start_date);
        $endDate = Carbon::parse($event->end_date);

        if ($endDate->isPast()) {
            return 'Terminé';
        }

        // Vérifier si tous les types de billets sont complets
        $isComplet = true;
        foreach ($event->ticketTypes as $type) {
            $ticketsSold = $type->tickets()->where('status', '!=', 'cancelled')->count();
            if ($ticketsSold < $type->quantity) {
                $isComplet = false;
                break;
            }
        }

        if ($isComplet) {
            return 'Complet';
        } elseif ($startDate->isPast() && $endDate->isFuture()) {
            return 'En cours';
        } else {
            return 'À venir';
        }
    }

    private function getStatusColor($status)
    {
        return match($status) {
            'Terminé' => 'bg-gray-100 text-gray-800',
            'Complet' => 'bg-red-100 text-red-800',
            'En cours' => 'bg-yellow-100 text-yellow-800',
            'À venir' => 'bg-green-100 text-green-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
} 
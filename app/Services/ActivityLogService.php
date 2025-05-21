<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;

class ActivityLogService
{
    public function log($subject, string $description, array $properties = [])
    {
        try {
            $log = ActivityLog::create([
                'entityType' => get_class($subject),
                'entityId' => $subject->id,
                'action' => $description,
                'details' => $properties,
                'userId' => auth()->id(),
                'ipAddress' => request()->ip()

            ]);
            
            // Debug info
            info('Log créé avec succès', [
                'log_id' => $log->id,
                'entityType' => get_class($subject),
                'entityId' => $subject->id,
                'action' => $description,
                'details' => $properties
            ]);
            
            return $log;
        } catch (\Exception $e) {
            // Log l'erreur
            info('Erreur lors de la création du log', [
                'error' => $e->getMessage(),
                'entityType' => get_class($subject),
                'entityId' => $subject->id,
                'action' => $description
            ]);
            throw $e;
        }
    }

    public function getTicketTypeStats($ticketType)
    {
        // Récupérer tous les logs pour ce type de ticket
        $logs = ActivityLog::where('entityType', get_class($ticketType))
            ->where('entityId', $ticketType->id)
            ->orderBy('created_at', 'asc')
            ->get();

        // Initialiser les compteurs
        $initialQuantity = 0;
        $addedQuantity = 0;
        $removedQuantity = 0;

        // Calculer les totaux
        foreach ($logs as $log) {
            $quantity = intval($log->details['quantity'] ?? 0);
            
            switch ($log->action) {
                case 'create_ticket_type':
                    $initialQuantity = $quantity;
                    break;
                case 'add_quantity':
                    $addedQuantity += $quantity;
                    break;
                case 'remove_quantity':
                    $removedQuantity += $quantity;
                    break;
            }
        }

        // Calculer le total mis en vente
        $totalPutOnSale = $initialQuantity + $addedQuantity;

        // Calculer les tickets disponibles
        $availableTickets = $totalPutOnSale - $removedQuantity;

        // Nombre de tickets vendus (à implémenter plus tard avec la gestion des ventes)
        $soldTickets = 0;

        return [
            'initial_quantity' => $initialQuantity,
            'total_added' => $addedQuantity,
            'total_removed' => $removedQuantity,
            'total_put_on_sale' => $totalPutOnSale,
            'sold_tickets' => $soldTickets,
            'available_tickets' => $availableTickets
        ];
    }
}

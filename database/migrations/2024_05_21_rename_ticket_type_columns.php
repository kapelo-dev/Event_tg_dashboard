<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTicketTypeColumns extends Migration
{
    public function up()
    {
        Schema::rename('TicketType', 'ticket_types');

        Schema::table('ticket_types', function (Blueprint $table) {
            // Renommer les colonnes en snake_case
            $table->renameColumn('eventId', 'event_id');
            
            // Ajouter les timestamps si ils n'existent pas
            if (!Schema::hasColumn('ticket_types', 'created_at')) {
                $table->timestamps();
            }
        });

        // Mettre à jour les clés étrangères dans la table tickets
        Schema::table('tickets', function (Blueprint $table) {
            $table->renameColumn('ticketTypeId', 'ticket_type_id');
        });
    }

    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->renameColumn('ticket_type_id', 'ticketTypeId');
        });

        Schema::table('ticket_types', function (Blueprint $table) {
            $table->renameColumn('event_id', 'eventId');
            $table->dropTimestamps();
        });

        Schema::rename('ticket_types', 'TicketType');
    }
}

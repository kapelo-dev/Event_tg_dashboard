<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('ActivityLog', function (Blueprint $table) {
            // Ajout des colonnes pour le suivi des tickets
            $table->string('subject_type')->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->string('description')->nullable();
            $table->json('properties')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down()
    {
        Schema::table('ActivityLog', function (Blueprint $table) {
            $table->dropColumn([
                'subject_type',
                'subject_id',
                'description',
                'properties',
                'created_at',
                'updated_at'
            ]);
        });
    }
};

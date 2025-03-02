<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            // Clé étrangère vers la table users (pour savoir qui a réservé)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
    
            // Clé étrangère vers la table place_parkings (pour savoir quelle place est réservée)
            $table->foreignId('place_parking_id')->nullable()->constrained()->onDelete('set null');
    
            // Date/heure de début et d'expiration de la réservation
            $table->timestamp('debut')->nullable();
            $table->timestamp('expiration')->nullable();
    
            // Statut de la réservation : active, expirée, annulée
            $table->enum('statut', ['active', 'expirée', 'annulée'])->default('active');
    
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};

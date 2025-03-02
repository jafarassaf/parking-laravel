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
        Schema::create('place_parkings', function (Blueprint $table) {
            $table->id();
            #colonnes ajoutées (champs)
                $table->string('numero')->unique();
                $table->boolean('est_libre')->default(true);    
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('place_parkings');
    }
};

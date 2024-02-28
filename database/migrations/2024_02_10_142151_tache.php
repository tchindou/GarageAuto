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
        //
        Schema::create('tache', function (Blueprint $table) {
            $table->id();
            $table->foreignId('garage_id')->constrained('employe')->cascadeOnDelete();
            $table->foreignId('vehicule_id')->constrained('vehicule')->cascadeOnDelete();
            $table->string('name');
            $table->string('date_fin');
            $table->string('time')->nullable();
            $table->string('description');
            $table->string('image')->nullable();
            $table->enum('status', ['encours', 'fini', 'annule'])->default('encours');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('tache');
    }
};

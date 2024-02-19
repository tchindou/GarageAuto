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
        Schema::create('intervention', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicule_id')->constrained('vehicule')->cascadeOnDelete();
            $table->foreignId('garage_id')->constrained('garage')->cascadeOnDelete();
            $table->foreignId('tache_id')->constrained('tache')->cascadeOnDelete();
            $table->dateTime('date')->default(now());
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intervention');
    }
};

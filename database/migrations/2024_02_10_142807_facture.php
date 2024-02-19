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
        Schema::create('facture', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intervention_id')->constrained('intervention')->cascadeOnDelete();
            $table->foreignId('garage_id')->constrained('garage')->cascadeOnDelete();
            $table->String('piece');
            $table->integer('quantite')->default(1)->nullable();
            $table->integer('prix_unitaire');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facture');
    }
};

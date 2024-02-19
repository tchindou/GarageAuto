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
        Schema::create('vehicule', function (Blueprint $table) {
            $table->id();
            $table->foreignId('garage_id')->constrained('garage')->cascadeOnDelete();
            $table->foreignId('client_id')->constrained('client')->cascadeOnDelete();
            $table->string('marque');
            $table->string('modele');
            $table->string('plaque');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicule');
    }
};

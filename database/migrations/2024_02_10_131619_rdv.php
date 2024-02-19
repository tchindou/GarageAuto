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
        Schema::create('rdv', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('client')->cascadeOnDelete();
            $table->foreignId('garage_id')->constrained('garage')->cascadeOnDelete();
            $table->string('date');
            $table->string('time');
            $table->string('description');
            $table->string('image')->nullable();
            $table->boolean('valide')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rdv');
    }
};

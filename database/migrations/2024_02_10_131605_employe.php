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
        Schema::create('employe', function (Blueprint $table) {
            $table->id();
            $table->foreignId('garage_id')->constrained('garage')->cascadeOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->enum('status', ['nouveau', 'ex', 'mute'])->default('nouveau');
            $table->string('tel');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employe');
    }
};

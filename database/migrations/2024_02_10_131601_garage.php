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
        Schema::create('garage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gerant_id')->constrained('gerant')->cascadeOnDelete();
            $table->string('name');
            $table->string('gar_tel');
            $table->string('email');
            $table->string('addresse');
            $table->string('map_url')->nullable();
            $table->string('description');
            $table->string('image');
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('valide')->default(false);
            $table->bigInteger('likes')->default(0);
            $table->integer('boost')->default(0);
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
        Schema::dropIfExists('garage');
    }
};

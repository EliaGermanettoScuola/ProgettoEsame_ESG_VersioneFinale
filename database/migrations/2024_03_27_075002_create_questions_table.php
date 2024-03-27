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
        Schema::create('questions', function (Blueprint $table) {
            $table->id('idQuesito');
            $table->unsignedBigInteger('idDomanda');
            $table->unsignedBigInteger('idRisposta');
            $table->integer('Punteggio');
            $table->timestamps();

            $table->foreign('idDomanda')->references('idDomanda')->on('demands')->onDelete('cascade');
            $table->foreign('idRisposta')->references('idRisposta')->on('answers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};

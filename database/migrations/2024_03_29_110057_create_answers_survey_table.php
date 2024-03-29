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
        Schema::create('answers_survey', function (Blueprint $table) {
            $table->id('idRispostaQuestionario');
            $table->unsignedBigInteger('idQuestionario');
            $table->unsignedBigInteger('idDomanda');
            $table->unsignedBigInteger('idRisposta');
            $table->timestamps();

            $table->foreign('idQuestionario')->references('idQuestionario')->on('questionnaires')->onDelete('cascade');
            $table->foreign('idDomanda')->references('idDomanda')->on('questions')->onDelete('cascade');
            $table->foreign('idRisposta')->references('idRisposta')->on('answers')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers_survey');
    }
};

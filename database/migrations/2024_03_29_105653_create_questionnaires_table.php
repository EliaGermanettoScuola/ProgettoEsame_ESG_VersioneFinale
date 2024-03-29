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
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->id('idQuestionario');
            $table->unsignedBigInteger('idUtente');
            $table->integer('stato');
            $table->date('dataInizio');
            $table->date('dataUltimoAggiornamento');
            $table->timestamps();

            $table->foreign('idUtente')->references('idUtente')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionnaires');
    }
};

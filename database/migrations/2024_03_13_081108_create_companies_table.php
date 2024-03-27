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
        Schema::create('companies', function (Blueprint $table) {
            $table->id('idCompanies') -> unique();
            $table->string('ragioneSociale');
            $table->string('partitaIva')->unique();
            $table->string('codiceFiscale')->unique();
            $table->string('indirizzo');
            $table->string('citta');
            $table->string('cap');
            $table->string('provincia');
            $table->string('telefono');
            $table->unsignedBigInteger('idUtente');
            $table->timestamps();

            $table->foreign('idUtente')->references('idUtente')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};

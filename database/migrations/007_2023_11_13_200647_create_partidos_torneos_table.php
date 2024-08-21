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
        Schema::create('partido_torneos', function (Blueprint $table) { #PartidosTorneo table
            #FK1
            $table->unsignedBigInteger('torneo_id');
            $table->foreign('torneo_id')->references('id')->on('torneos')->onDelete('cascade'); #Restrict id reference
            #FK2
            $table->unsignedBigInteger('partido_id');
            $table->foreign('partido_id')->references('id')->on('partidos')->onDelete('cascade'); #Restrict id reference
            #Attribute outside table definition
            $table->timestamps();  #Date and time of any change
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partido_torneos');
    }
};

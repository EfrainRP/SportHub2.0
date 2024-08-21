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
        Schema::create('partidos', function (Blueprint $table) { #Partidos table 
            $table->id();
            $table->time('horaPartido');
            $table->date('fechaPartido');
            $table->date('jornada');
            $table->integer('resLocal')->unsigned()->nullable();     # Resultado Local = Natural number
            $table->integer('resVisitante')->unsigned()->nullable(); # Resultado Visitante   = Natural number
            #FK1
            $table->unsignedBigInteger('equipoLocal_id');
            $table->foreign('equipoLocal_id')->references('id')->on('equipos')->onDelete('cascade'); #Restrict id reference
            #FK2
            $table->unsignedBigInteger('equipoVisitante_id');
            $table->foreign('equipoVisitante_id')->references('id')->on('equipos')->onDelete('cascade'); #Restrict id reference
            #Attribute outside table definition
            $table->timestamps();  #Date and time of any change
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidos');
    }
};

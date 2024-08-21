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
        Schema::create('estadisticas', function (Blueprint $table) { #Estadisticas table
            #FK1
            $table->unsignedBigInteger('torneo_id');
            $table->foreign('torneo_id')->references('id')->on('torneos')->onDelete('cascade'); #Restrict id reference
            #FK2
            $table->unsignedBigInteger('equipo_id');
            $table->foreign('equipo_id')->references('id')->on('equipos')->onDelete('cascade'); #Restrict id reference
            #Atributes
            $table->integer('PT')->unsigned()->default(0); # PT = Natural number
            $table->integer('CA')->unsigned()->default(0); # CA = Natural number
            $table->integer('DC')->default(0); # DC = Natural number
            $table->integer('CC')->unsigned()->default(0); # CC = Natural number
            #Attribute outside table definition
            $table->timestamps();  #Date and time of any change
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estadisticas');
    }
};

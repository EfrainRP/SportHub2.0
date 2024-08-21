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
        Schema::create('torneos', function (Blueprint $table) { #Torneos table
            $table->id();
            $table->string('name');
            $table->string('ubicacion');
            $table->string('tipoJuego');
            $table->string('descripcion');
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->string('tipoTorneo'); 
            $table->integer('cantEquipo')->unsigned()->default(0); # cantEquipo = Natural number
            #FK
            $table->unsignedBigInteger('user_id');     #ID_Usuario_Organizador
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); #Restrict id reference
            #Attribute outside table definition
            $table->timestamps();  #Date and time of any change
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('torneos');
    }
};

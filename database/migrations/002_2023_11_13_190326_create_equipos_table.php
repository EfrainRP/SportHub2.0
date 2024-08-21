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
        Schema::create('equipos', function (Blueprint $table) { #Equipos table
            $table->id();
            $table->string('name');
            $table->string('tipoJuego');
            #FK 
            $table->unsignedBigInteger('user_id');  #ID_Usuario_Representante
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); #Restrict id reference
            #Attribute outside table definition
            $table->timestamps(); #Date and time of any change
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};

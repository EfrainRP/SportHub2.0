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
        Schema::create('miembro_equipos', function (Blueprint $table) { #MiembrosEquipo table
            $table->string('user_miembro');
            #FK1
            $table->unsignedBigInteger('equipo_id');
            $table->foreign('equipo_id')->references('id')->on('equipos')->onDelete('cascade'); #Restrict id reference
            #Attribute outside table definition
            $table->timestamps();  #Date and time of any change
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('miembroEquipos');
    }
};

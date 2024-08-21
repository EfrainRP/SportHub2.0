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
        Schema::create('notifications', function (Blueprint $table) {
            #FK 
            $table->unsignedBigInteger('equipo_id')->nullable();  #ID_Usuario_Representante
            $table->foreign('equipo_id')->references('id')->on('equipos')->onDelete('cascade'); #Restrict id reference
            #FK 
            $table->unsignedBigInteger('torneo_id')->nullable();    #ID_Usuario_Organizador
            $table->foreign('torneo_id')->references('id')->on('torneos')->onDelete('cascade'); #Restrict id reference
            #FK 
            $table->unsignedBigInteger('user_id');  #ID_Usuario_Participante
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); #Restrict id reference
            #FK 
            $table->unsignedBigInteger('user_id2')->nullable();  #ID_Usuario
            $table->foreign('user_id2')->references('id')->on('users')->onDelete('cascade'); #Restrict id reference
            #Status
            #Status
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};

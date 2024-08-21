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
        Schema::create('participante_torneos', function (Blueprint $table) {
            #FK1
            $table->unsignedBigInteger('torneo_id');
            $table->foreign('torneo_id')->references('id')->on('torneos')->onDelete('cascade'); #Restrict id reference
            #FK2
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); #Restrict id reference
            #Atributes
            $table->integer('PT')->unsigned()->default(0); # PT = Natural number
            $table->integer('CA')->unsigned()->default(0); # CA = Natural number
            $table->integer('DC')->default(0); # DC = Natural number
            $table->integer('CC')->unsigned()->default(0); # CC = Natural number
            #Attribute outside table definition
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participante_torneos');
    }
};

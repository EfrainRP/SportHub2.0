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
    {   #Laragon terminal command: php artisan migrate (run the migrations)
        #Laragon terminal command: drop and add all migrations-> php artisan migrate:fresh
        Schema::create('users', function (Blueprint $table) { #Users Table
            $table->id();
            $table->string('name', 60);
            $table->string('fsurname', 50); #Father's surname
            $table->string('msurname', 50); #Mother's surname
            $table->string('nickname', 50)->nullable()->unique(); 
            $table->string('email')->unique(); #Default length 255
            $table->string('gender')->default('N/E');   #Default length 255
            $table->string('password'); #Default length 255
            $table->date('birthdate')->default("2023/12/1");
            $table->string('image')->default('userprofile.webp');
            $table->rememberToken(); #Remember Accont
            #Attribute outside table definition
            $table->timestamps(); #Date and time of any change
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

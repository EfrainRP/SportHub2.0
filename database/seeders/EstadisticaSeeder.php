<?php

namespace Database\Seeders;

use App\Models\Estadistica;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadisticaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create a new estadistica object 
        $estadistica = new Estadistica();
        //Assigns attribute values
        $estadistica->torneo_id = 1;
        $estadistica->equipo_id = 1;
        $estadistica->PT = 25;
        $estadistica->CA = 5;
        $estadistica->DC = 10;
        $estadistica->CC = 7;
        //Save the record to the database
        $estadistica->save();
    }
}

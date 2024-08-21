<?php

namespace Database\Seeders;

use App\Models\PartidoTorneo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartidoTorneoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create a new partidoTorneo object 
        $partidoTorneo = new PartidoTorneo();
        //Assigns attribute values
        $partidoTorneo->torneo_id = 1;
        $partidoTorneo->partido_id = 1;
        //Save the record to the database
        $partidoTorneo->save();
    }
}

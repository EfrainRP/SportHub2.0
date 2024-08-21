<?php

namespace Database\Seeders;

use App\Models\Partido;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create a new partido object 
        $partido = new Partido();
        //Assigns attribute values
        $partido->horaPartido = "12:30:00";
        $partido->fechaPartido = "2023/12/26";
        $partido->jornada = "2023/12/1";
        $partido->resLocal = 22;
        $partido->resVisitante = 14;
        $partido->equipoLocal_id = 1;
        $partido->equipoVisitante_id = 1;
        //Save the record to the database
        $partido->save();
    }
}

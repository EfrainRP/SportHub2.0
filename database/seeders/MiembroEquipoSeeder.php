<?php

namespace Database\Seeders;

use App\Models\MiembroEquipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MiembroEquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void  
    {
        //Create a new MiembroEquipo object 
        $miembro = new MiembroEquipo();
        //Assigns attribute values
        $miembro->user_miembro = "Saul";
        $miembro->equipo_id = 1;
        //Save the record to the database
        $miembro->save();
    }
}

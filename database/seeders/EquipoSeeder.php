<?php

namespace Database\Seeders;

use App\Models\Equipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create a new equipo object 
        $equipo = new Equipo();
        //Assigns attribute values
        $equipo->name = "Venenos";
        $equipo->tipoJuego = "Basketball";
        $equipo->user_id = 1;  #ID_Usuario_Representante
        //Save the record to the database
        $equipo->save();
        //Create 10 random teams (database\factories\EquipoFactory)
        Equipo::factory(40)->create();
    }
}

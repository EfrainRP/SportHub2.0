<?php


namespace Database\Seeders;

use App\Models\Torneo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TorneoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create a new torneo object 
        $torneo = new Torneo();
        //Assigns attribute values
        $torneo->name = "CopaGDL";
        $torneo->ubicacion = "Guadalajara";
        $torneo->tipoJuego = "Basketball";
        $torneo->descripcion = "GDL Tournament";
        $torneo->fechaInicio = "2023/12/15";
        $torneo->fechaFin = "2023/12/25";
        $torneo->tipoTorneo = "Equipos";
        $torneo->cantEquipo = 10;    #Max Equipo
        $torneo->user_id = 1;        #ID_Usuario_Organizador
        //Save the record to the database
        $torneo->save();
        //Create a new torneo object 
        $torneo = new Torneo();
        $torneo->name = "Bacheritos";
        $torneo->ubicacion = "Tlajomulco";
        $torneo->tipoJuego = "Basketball";
        $torneo->descripcion = "GDL Tournament";
        $torneo->fechaInicio = "2023/12/11";
        $torneo->fechaFin = "2023/12/30";
        $torneo->tipoTorneo = "Individual";
        $torneo->cantEquipo = 6;    #Max Equipo
        $torneo->user_id = 1;        #ID_Usuario_Organizador
        //Save the record to the database
        $torneo->save();
    }
}

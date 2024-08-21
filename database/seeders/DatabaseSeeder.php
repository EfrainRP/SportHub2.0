<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{   #Laravel Commands --> default --> php artisan migrate:fresh --seed 
    #php artisan migrate:fresh           (Drop and Create the tables to the DataBase)
    #php artisan migrate:fresh --seed    (Drop and Create the tables and also add the records to the DataBase)
    #php artisan db:seed                 (Add the records to the DataBase)
    #php artisan make:seeder NameSeeder  (Create Seeder)
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        // \App\Models\User::factory(10)->create();
 
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        #Default table records (Seeders)
        $this->call(UserSeeder::class);           #Initializes the records of the Users table
        $this->call(EquipoSeeder::class);         #Initializes the records of the Equipos table
        $this->call(MiembroEquipoSeeder::class);  #Initializes the records of the MiembrosEquipos table
        $this->call(TorneoSeeder::class);         #Initializes the records of the Torneos table
        $this->call(EstadisticaSeeder::class);    #Initializes the records of the Estadisticas table
        $this->call(PartidoSeeder::class);        #Initializes the records of the Partidos table
        $this->call(PartidoTorneoSeeder::class);  #Initializes the records of the PartidosTorneos table
    }
}

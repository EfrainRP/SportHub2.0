<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipo>
 */
class EquipoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [ #Returns the value of the attributes
            "name" =>$this->faker->name(),                                                                       
            "tipoJuego"=>$this->faker->randomElement(['Basketball']),                                                                                      
            "user_id"=>$this->faker->numberBetween(1, 1)
        ];
    }
}

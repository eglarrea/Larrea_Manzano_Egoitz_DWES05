<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class SalaFactory extends Factory
{
   

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'idSala' => fake()->randomElement([1,2,3,4], 2,true),
           // 'idSala' => fake()->unique(),
            'pelicula' => fake()->text()    ,
            'aforo' =>  fake()->numberBetween(50,100),
            'es3d' => fake()->numberBetween(0,1)
        ];
    }
}

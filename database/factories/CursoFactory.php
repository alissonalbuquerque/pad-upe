<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Curso;

class CursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Curso::class;
    // protected $array_campus_id = array_map(Campus::all(), function($campus) { return $campus->id } );

    public function definition()
    {
        return [
            'name' => $this->faker->name,
//            'campus_id' => $this->faker->randomElement($listCampus),
        ];
    }
}

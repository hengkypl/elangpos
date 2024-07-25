<?php

namespace Database\Factories;
use App\Models\TidakTerdaftar;
use Illuminate\Database\Eloquent\Factories\Factory;

class TidakTerdaftarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kassa' => $this->faker->lexify('??????????'), // 10 random letters
            'operator' => $this->faker->lexify('??????????'), // 10 random letters
            'kodebarang' => $this->faker->lexify('????????????????????'), // 20 random letters
        ];
    }
}

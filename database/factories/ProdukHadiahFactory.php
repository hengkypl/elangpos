<?php

namespace Database\Factories;

use App\Models\Produkhadiah;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProdukHadiahFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Produkhadiah::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'namabarang' => $this->faker->word,
            'point' => $this->faker->numberBetween(1, 50),
            'keterangan' => $this->faker->sentence,
            'foto' => 'public/fotos/default.jpg', // replace with a real path to a default image if necessary
        ];
    }
}

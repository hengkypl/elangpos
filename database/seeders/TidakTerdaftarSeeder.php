<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TidakTerdaftar;

class TidakTerdaftarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TidakTerdaftar::factory()->count(50)->create();
    }
}

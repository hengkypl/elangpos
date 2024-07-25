<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TidakTerdaftar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(ProdukHadiahSeeder::class);
        TidakTerdaftar::factory()->count(50)->create();
    }
}

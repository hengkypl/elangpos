<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produkhadiah;

class ProdukHadiahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Produkhadiah::factory()->count(100)->create(); // create 50 fake records
    }
}

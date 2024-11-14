<?php

namespace Database\Seeders;

use App\Models\City;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        $this->call([
            CitySeeder::class
        ]);
        
        // Ambil data setelah seeding
        $cities = City::all();
    
        // Lakukan apa pun yang perlu dilakukan dengan data yang diperoleh
    }
}

<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Room;
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
            CitySeeder::class,
            RoomSeeder::class
        ]);
        
        // Ambil data setelah seeding
        $cities = City::all();
        $rooms = Room::all();
    
        // Lakukan apa pun yang perlu dilakukan dengan data yang diperoleh
    }
}

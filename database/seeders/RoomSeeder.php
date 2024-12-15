<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run()
    {
        $rooms = [
            [
                
                'name' => 'Kamar A',
                'description' => 'Kamar nyaman dengan fasilitas lengkap.',
                'price_per_month' => 2000000,
                'square_feet' => 20, // Luas kamar dalam meter persegi
                'is_available' => '1',
                'available_rooms' => 5,
            ],
            [
                
                'name' => 'Kamar B',
                'description' => 'Kamar dengan balkon dan pemandangan.',
                'price_per_month' => 2500000,
                'square_feet' => 25,
                'is_available' => '1',
                'available_rooms' => 3,
            ],
            [
               
                'name' => 'Kamar C',
                'description' => 'Kamar luas dengan fasilitas AC.',
                'price_per_month' => 1800000,
                'square_feet' => 30,
                'is_available' => '1',
                'available_rooms' => 7,
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}

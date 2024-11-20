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
                'id_city' => '5',
                'name_room' => 'Kamar A',
                'room_type' => 'putra',
                'description' => 'Kamar nyaman dengan fasilitas lengkap.',
                'price_per_month' => 2000000,
                'address' => 'Jl. Raya No. 10, Jakarta',
                'square_feet' => 20, // Luas kamar dalam meter persegi
                'is_available' => '1',
                'available_rooms' => 5,
            ],
            [
                'id_city' => '4',
                'name_room' => 'Kamar B',
                'room_type' => 'putri',
                'description' => 'Kamar dengan balkon dan pemandangan.',
                'price_per_month' => 2500000,
                'address' => 'Jl. Merdeka No. 25, Bandung',
                'square_feet' => 25,
                'is_available' => '1',
                'available_rooms' => 3,
            ],
            [
                'id_city' => '2',
                'name_room' => 'Kamar C',
                'room_type' => 'campur',
                'description' => 'Kamar luas dengan fasilitas AC.',
                'price_per_month' => 1800000,
                'address' => 'Jl. Pantai No. 15, Surabaya',
                'square_feet' => 30,
                'is_available' => '1',
                'available_rooms' => 7,
            ],
            // Tambahkan data lainnya sesuai kebutuhan
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}

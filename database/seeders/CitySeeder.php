<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::create([
            'name_city' => 'Gresik',
            'slug' => 'gsk'

        ]);
        City::create([
            'name_city' => 'Surabaya',
            'slug' => 'sby'

        ]);
        City::create([
            'name_city' => 'Malang',
            'slug' => 'mlg'

        ]);
        City::create([
            'name_city' => 'Bandung',
            'slug' => 'bdg'

        ]);
        City::create([
            'name_city' => 'Jakarta',
            'slug' => 'jkt'

        ]);
    }
}

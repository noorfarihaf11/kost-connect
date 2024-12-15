<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
   
    public function run(): void
    {
        User::create([
            'name' => 'Sakhwa Ratifa',
            'email' => 'sakhwa@gmail.com',
            'password' => Hash::make('sakhwa'),
            'id_role' => '1'
        ]);      

    }
}
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::truncate();
        User::create([
            'name' => 'Jeremy',
            'email' => 'jeremy@gmail.com',
            'password' => Hash::make('123'),
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::truncate();
        User::created([
            'name' => 'Jeremy',
            'email' => 'jeremy@gmail.com',
            'password' => bcrypt('123'),
            'remember_token' => Str::random(60)
        ]);
    }
}

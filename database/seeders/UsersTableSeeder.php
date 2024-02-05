<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create 100 admin
        User::factory(100)->create(['role' => 'admin']);

        // Create 10,000 users
        User::factory(10000)->create();

    }
}
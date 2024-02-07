<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::create([
            'name' => 'Talha',
            'email' => 'talhashinwari7474@gmail.com',
            'password' => bcrypt('talha1122'),
        ]);
        $user1->assignRole('admin');

        $user = User::create([
            'name' => 'Test User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user1122'),
        ]);
        $user->assignRole('user');
    }
}

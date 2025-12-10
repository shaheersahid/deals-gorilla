<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersToCreate = [
            [
                'name' => 'Muhammad Usman',
                'email' => 'admin@dealsgorilla.com',
                'email_verified_at' => now(),
                'password' => bcrypt("3';F4b}Pa.Nnd]!"),
                'is_admin' => 1
            ],
            [
                'name' => 'Shaheer Shahid',
                'email' => 'shaheer608@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt("3';F4b}Ka.Nnd]9"),
                'system_permissions' => 1,
                'is_admin' => 1
            ],
        ];

        foreach ($usersToCreate as $userData) {
            User::firstOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}

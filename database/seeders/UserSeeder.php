<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@archex.com',
                'password' => Hash::make('12345678'),
                'is_admin' => true,
            ],
            [
                'name' => 'Tmawada',
                'username' => 'tmawada',
                'email' => 'tmawada@archex.com',
                'password' => Hash::make('12345678'),
                'is_admin' => false,
            ],
            [
                'name' => 'John Doe',
                'username' => 'johndoe',
                'email' => 'john@archex.com',
                'password' => Hash::make('12345678'),
                'is_admin' => false,
            ],
            [
                'name' => 'Jane Smith',
                'username' => 'janesmith',
                'email' => 'jane@archex.com',
                'password' => Hash::make('12345678'),
                'is_admin' => false,
            ],
            [
                'name' => 'Mike Johnson',
                'username' => 'mikej',
                'email' => 'mike@archex.com',
                'password' => Hash::make('12345678'),
                'is_admin' => false,
            ],
            [
                'name' => 'Sarah Williams',
                'username' => 'sarahw',
                'email' => 'sarah@archex.com',
                'password' => Hash::make('12345678'),
                'is_admin' => false,
            ],
            [
                'name' => 'David Brown',
                'username' => 'davidb',
                'email' => 'david@archex.com',
                'password' => Hash::make('12345678'),
                'is_admin' => false,
            ],
            [
                'name' => 'Emily Davis',
                'username' => 'emilyd',
                'email' => 'emily@archex.com',
                'password' => Hash::make('12345678'),
                'is_admin' => false,
            ],
            [
                'name' => 'Chris Wilson',
                'username' => 'chrisw',
                'email' => 'chris@archex.com',
                'password' => Hash::make('12345678'),
                'is_admin' => false,
            ],
            [
                'name' => 'Lisa Anderson',
                'username' => 'lisaa',
                'email' => 'lisa@archex.com',
                'password' => Hash::make('12345678'),
                'is_admin' => false,
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}

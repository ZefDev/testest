<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Создание администратора
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'first_name' => 'admin',
                'last_name' => 'admin',
                'phone' => '+1234567890',
                'password' => Hash::make('1234'),
            ]
        );

        // Присвоение роли администратора администратору
        $admin->roles()->sync([$adminRole->id]);
    }
}

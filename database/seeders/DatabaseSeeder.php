<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Run Permissions and Roles only
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
        ]);

        // 2. Create Admin User
        $admin = User::updateOrCreate(
            ['email' => 'admin@optical.com'],
            ['name' => 'Admin User', 'password' => Hash::make('password')]
        );
        $admin->assignRole('Admin');

        // 3. Create Manager User
        $manager = User::updateOrCreate(
            ['email' => 'manager@optical.com'],
            ['name' => 'Manager User', 'password' => Hash::make('password')]
        );
        $manager->assignRole('Manager');

        // 4. Create Employee User
        $employee = User::updateOrCreate(
            ['email' => 'employee@optical.com'],
            ['name' => 'Employee User', 'password' => Hash::make('password')]
        );
        $employee->assignRole('Employee');
    }
}
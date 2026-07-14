<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view customers', 'create customers', 'edit customers', 'delete customers',
            'view products', 'create products', 'edit products', 'delete products',
            'view categories', 'create categories', 'edit categories', 'delete categories',
            'view brands', 'create brands', 'edit brands', 'delete brands',
            'view prescriptions', 'create prescriptions', 'edit prescriptions', 'delete prescriptions',
            'view orders', 'create orders', 'edit orders', 'delete orders',
            'view reservations', 'create reservations', 'edit reservations', 'delete reservations',
            'view payments', 'create payments', 'edit payments', 'delete payments',
            'view invoices',
            'view inventory', 'manage inventory',
            'view reports',
            'manage users', 'manage roles', 'manage settings',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'customers.view', 'customers.create', 'customers.edit', 'customers.delete',
            'products.view', 'products.create', 'products.edit', 'products.delete',
            'categories.view', 'categories.create', 'categories.edit', 'categories.delete',
            'brands.view', 'brands.create', 'brands.edit', 'brands.delete',
            'prescriptions.view', 'prescriptions.create', 'prescriptions.edit', 'prescriptions.delete',
            'orders.view', 'orders.create', 'orders.edit', 'orders.delete',
            'reservations.view', 'reservations.create', 'reservations.edit', 'reservations.delete',
            'stock-movements.view', 'stock-movements.create', 'stock-movements.edit', 'stock-movements.delete',
            'suppliers.view', 'suppliers.create', 'suppliers.edit', 'suppliers.delete',
            'purchase-orders.view', 'purchase-orders.create', 'purchase-orders.edit', 'purchase-orders.delete',
            'invoices.view', 'invoices.create', 'invoices.delete',
            'payments.view', 'payments.create', 'payments.delete',
            'inventory.view', 'inventory.manage',
            'view-reports',
            'users.manage', 'roles.manage', 'settings.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Clear cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Create Roles
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $manager = Role::firstOrCreate(['name' => 'Manager']);
        $employee = Role::firstOrCreate(['name' => 'Employee']);

        // 3. Get all permissions
        $allPermissions = Permission::all();

        // 4. ADMIN: Gets EVERYTHING
        $admin->givePermissionTo($allPermissions);

        // 5. MANAGER: Gets everything EXCEPT user/role/settings management
        $managerPermissions = $allPermissions->filter(function ($permission) {
            return !in_array($permission->name, ['users.manage', 'roles.manage', 'settings.manage']);
        });
        $manager->givePermissionTo($managerPermissions);

        // 6. EMPLOYEE: Gets ONLY specific view/create/edit permissions (NO delete, NO reports, NO settings)
        $employeePermissions = Permission::whereIn('name', [
            'customers.view', 'customers.create', 'customers.edit',
            'prescriptions.view', 'prescriptions.create', 'prescriptions.edit',
            'reservations.view', 'reservations.create', 'reservations.edit',
            'orders.view', 'orders.create', 'orders.edit',
            'payments.view', 'payments.create', 'payments.edit',
            'products.view', 'categories.view', 'brands.view', 'invoices.view'
        ])->get();
        
        $employee->givePermissionTo($employeePermissions);
    }
}
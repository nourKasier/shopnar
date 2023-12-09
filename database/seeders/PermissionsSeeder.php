<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or retrieve the permissions
        Permission::firstOrCreate(['name' => 'manage-products', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'manage-categories', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'create-admins', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'assign-permissions', 'guard_name' => 'web']);
    }
}

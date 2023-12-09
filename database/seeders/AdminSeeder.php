<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed the super admin
        $superAdmin = User::firstOrCreate([
            'name' => 'Super Admin',
            'email' => 'superadmin@superadmin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);

        $superAdminRole = Role::where('name', 'super-admin')->first();
        $superAdmin->assignRole($superAdminRole);

        // Assign all permissions to the 'super admin' role
        $permissions = Permission::pluck('id')->toArray();
        $superAdminRole->syncPermissions($permissions);

        // Seed five admins
        $adminsCount = 5;

        User::factory()->count($adminsCount)->create()->each(function ($admin) {
            // Assign the 'admin' role to each admin user
            $adminRole = Role::where('name', 'admin')->first();
            $admin->assignRole($adminRole);

            // Assign specific permissions to the 'admin' role
            $manageProductsPermission = Permission::where('name', 'manage-products')->first();
            $manageCategoriesPermission = Permission::where('name', 'manage-categories')->first();

            $adminRole->givePermissionTo($manageProductsPermission, $manageCategoriesPermission);

            // Assign permissions to the 'admin' model
            $admin->syncPermissions($manageProductsPermission, $manageCategoriesPermission);
        });
    }
}

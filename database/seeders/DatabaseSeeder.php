<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            PermissionsSeeder::class,
            RolesSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    
        // Assign permissions to roles
        $superAdminRole = Role::findByName('super-admin');
        $superAdminRole->givePermissionTo('manage-products');
        $superAdminRole->givePermissionTo('manage-categories');
    
        $adminRole = Role::findByName('admin');
        $adminRole->givePermissionTo('manage-products');
        $adminRole->givePermissionTo('manage-categories');
    }
}

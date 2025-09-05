<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'manage users',
            'manage jobs',
            'manage applications',
            'post jobs',
            'apply jobs',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $employer = Role::firstOrCreate(['name' => 'Employer']);
        $seeker = Role::firstOrCreate(['name' => 'Job Seeker']);

        $admin->givePermissionTo(['manage users', 'manage jobs', 'manage applications']);
        $employer->givePermissionTo(['post jobs', 'manage jobs']);
        $seeker->givePermissionTo(['apply jobs']);

        $superAdmin->givePermissionTo(Permission::all());
    }
}

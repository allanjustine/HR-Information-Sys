<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $role_admin = Role::create(['name' => 'admin']);
        Role::create(['name' => 'employee']);

        $user = User::create([
            'name'              => 'Administrator',
            'email'             => 'admin@gmail.com',
            'password'          => 'password',
            'email_verified_at' => now(),
        ]);

        $user->employeeProfile()->create([
            'employee_id' => 'EMP-000001',
        ]);

        $user->assignRole($role_admin);
    }
}

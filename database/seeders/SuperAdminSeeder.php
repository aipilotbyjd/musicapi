<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = Role::create(['guard_name' => 'superadmin', 'name' => 'superadmin']);
        $superadminuser = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => '12345678',
        ]);
        $superadminuser->assignRole($superadmin);
    }
}

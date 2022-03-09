<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'client']);


        // Permission::create(['name' => 'admin.rentings'])->syncRoles([$role1]);

        // Permission::create(['name' => 'admin.users.add'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.users.list'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.users.modify'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.users.remove'])->syncRoles([$role1]);

        // Permission::create(['name' => 'admin.vehicles.add'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.vehicles.list'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.vehicles.modify'])->syncRoles([$role1]);
        // Permission::create(['name' => 'admin.vehicles.remove'])->syncRoles([$role1]);


    }
}

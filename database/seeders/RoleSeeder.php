<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Guest']);

        $perm1 = Permission::create(['name' => 'productos.index']);
        $perm2 = Permission::create(['name' => 'productos.destroy']);
        $perm3 = Permission::create(['name' => 'productos.edit']);
        $perm4 = Permission::create(['name' => 'productos.create']);
        $perm5 = Permission::create(['name' => 'productos.show']);

        // Asignar permisos al rol Admin
        $role1->givePermissionTo($perm1, $perm2, $perm3, $perm4, $perm5);

        // Asignar permisos al rol Guest
        $role2->givePermissionTo($perm1);
    }
}

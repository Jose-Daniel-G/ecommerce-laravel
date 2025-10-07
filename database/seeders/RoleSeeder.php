<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{

    public function run()
    {

        // ----------------------------------------------------------------------------------------------
        // Crear roles y asignar permisos
        $superAdmin = Role::create(['name' => 'superAdmin']);
        $admin = Role::create(['name' => 'admin']);
        $admin->syncPermissions(['access dashboard',
            'manage options',
            'manage families',
            'manage categories',
            'manage subcategories',
            'manage products',
            'manage covers',
            'manage drivers',
            'manage orders',
            'manage shipments',]);
        $secretaria = Role::create(['name' => 'secretaria']);
        $profesor = Role::create(['name' => 'profesor']);
        $cliente = Role::create(['name' => 'cliente']);
       
    }
}

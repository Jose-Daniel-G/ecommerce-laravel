<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{ 
    public function run(): void
    {
        $permissions = [
            'access dashboard',
            'manage options',
            'manage families',
            'manage categories',
            'manage subcategories',
            'manage products',
            'manage covers',
            'manage drivers',
            'manage orders',
            'manage shipments',
        ];
        foreach ($permissions as $index => $permission) {
            Permission::create(['name'=>$permission]);
        }
    }
}

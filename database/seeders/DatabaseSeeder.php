<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Storage::deleteDirectory('products');
        //Storage::makeDirectory('products');

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            FamilySeeder::class,
            OptionSeeder::class,
            UserSeeder::class,
        ]);
        Product::factory(150)->create();
        // $this->call([VariantSeeder::class]);
    }
}

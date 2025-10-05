<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            FamilySeeder::class,
            OptionSeeder::class,
            RoleSeeder::class,
            AdminSeeder::class,
        ]);
         Product::factory(150)->create();
    }
}

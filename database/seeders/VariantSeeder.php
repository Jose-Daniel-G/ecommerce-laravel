<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Variant;
use App\Models\Product;
use Faker\Factory as Faker;

class VariantSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Asegurarse de que existan productos
        $products = Product::all();

        if ($products->isEmpty()) {
            $this->command->warn('⚠️ No hay productos en la base de datos. Ejecuta primero el ProductSeeder.');
            return;
        }

        foreach ($products as $product) { 
            Variant::create([
                'sku' => $faker->unique()->numberBetween(100000, 999999),
                'stock' => $faker->numberBetween(5, 100),
                'product_id' => $product->id,
            ]);
        }

        $this->command->info('✅ VariantsSeeder ejecutado correctamente.');
    }
}

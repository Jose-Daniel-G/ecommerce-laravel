<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sku' => $this->faker->unique()->numberBetween(100000, 999999),
            'name' => $this->faker->words(3,true), // 'true' para obtener una cadena de texto en lugar de un array o setence->()
            'description' => $this->faker->text(200),
            'image_path' => $this->faker->imageUrl(40, 480,null, false), // Si no deseas recrear una imagen tomas una url 
            // 'image_path' => 'products/'.$this->faker->image(storage_path('app/public/products'),640, 480,null, false), // no funciono
            'price' => $this->faker->randomFloat(2, 1, 1000), // Ejemplo, 2 decimales, min 1, max 1000
            'subcategory_id' => $this->faker->numberBetween(1,632), // Asumiendo que ya tienes Subcategories
        ];
    }
}

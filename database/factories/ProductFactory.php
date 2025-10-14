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
            'image_path' => 'https://picsum.photos/seed/' . $this->faker->uuid . '/640/480',
            // 'image_path' => 'products/'.$this->faker->image(storage_path('app/public/products'),640, 480,null, false), // no funciono
            'price' => $this->faker->randomFloat(2, 1, 1000), // Ejemplo, 2 decimales, min 1, max 1000
            'subcategory_id' => $this->faker->numberBetween(1,632), // Asumiendo que ya tienes Subcategories
        ];
    }
}
    // public function definition(): array
    // {
    //     $subcategory = Subcategory::inRandomOrder()->first(); // Obtiene una subcategoría al azar

    //     // Mapa de temas por subcategoría
    //     $topics = [
    //         'Celulares' => 'smartphone',
    //         'Computadores de escritorio' => 'computer',
    //         'Laptops' => 'laptop',
    //         'Juguetes' => 'toy',
    //         'Ropa interior' => 'clothing',
    //         'Zapatos' => 'shoes',
    //         'Perfumes' => 'perfume',
    //         'Audífonos' => 'headphones',
    //         'Muebles' => 'furniture',
    //         'Cuidado capilar' => 'cosmetics',
    //         'Bicicletas' => 'bicycle',
    //         'Electrodomestico' => 'appliance',
    //         'Frutas' => 'fruit',
    //         'Verduras' => 'vegetable',
    //         'Licores' => 'wine',
    //         'Mascotas' => 'pet',
    //         'Libros' => 'book',
    //     ];

    //     $keyword = $topics[$subcategory->name] ?? 'product';

    //     return [
    //         'sku' => $this->faker->unique()->numberBetween(100000, 999999),
    //         'name' => $this->faker->words(3, true),
    //         'description' => $this->faker->text(200),
    //         'image_path' => "https://loremflickr.com/640/480/{$keyword}?lock=" . $this->faker->unique()->numberBetween(1, 9999),
    //         'price' => $this->faker->randomFloat(2, 1, 1000),
    //         'subcategory_id' => $subcategory->id,
    //     ];
    // }
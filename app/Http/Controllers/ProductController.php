<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
    public function addOption(Request $request, Product $product)
    {
        $data = $request->validate([
            'option_id' => 'required|exists:options,id',
            'features' => 'required|array|min:1',
            'features.*' => 'required|string'
        ]);

        // Formatear features para el pivot
        $features = [];
        foreach ($data['features'] as $feature) {
            $featureModel = Feature::firstOrCreate([
                'option_id' => $data['option_id'],
                'description' => $feature
            ]);
            $features[] = [
                'id' => $featureModel->id,
                'description' => $featureModel->description,
                'value' => $featureModel->value ?? null
            ];
        }

        // Asignar opción al producto con pivot features
        $product->options()->attach($data['option_id'], ['features' => $features]);

        // Generar variantes automáticamente
        $this->generateVariants($product);

        return redirect()->back()->with('success', 'Opción agregada correctamente.');
    }
    protected function generateVariants(Product $product)
    {
        $features = $product->options->pluck('pivot.features');
        $combinations = $this->generateCombinations($features->toArray());

        // Borrar variantes viejas
        $product->variants()->delete();

        foreach ($combinations as $combination) {
            $variant = $product->variants()->create([
                'sku' => $product->sku . '-' . implode('-', $combination),
                'stock' => 0
            ]);
            $variant->features()->attach($combination);
        }
    }

    protected function generateCombinations(array $arrays, int $index = 0, array $combination = []): array
    {
        if ($index === count($arrays)) {
            return [$combination];
        }

        $result = [];
        foreach ($arrays[$index] as $item) {
            $temp = $combination;
            $temp[] = $item['id'];
            $result = array_merge($result, $this->generateCombinations($arrays, $index + 1, $temp));
        }

        return $result;
    }
}

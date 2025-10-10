<?php

namespace App\Livewire\Admin\Products;

use App\Models\Feature;
use App\Models\Option;
use App\Models\Variant;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProductVariants extends Component
{
    public $product;
    public $openModal = false;
    public $options;
    public $variant = [
        'option_id' => '',
        'features' => [
            [
                'id' => '',
                'value' => '',
                'description' => '',
            ]
        ],
    ];
    public function mount($product)
    {
        // $this->product = $product->load('options');
        $this->options = Option::all();
    }

    public function updateVariantOptionId()
    {
        $this->variant['features'] = [
            [
                'id' => '',
                'value' => '',
                'description' => '',
            ]
        ];
    }
    #[Computed()]
    public function features()
    {
        return Feature::where('option_id', $this->variant['option_id'])->get();
    }
    public function addFeature()
    {
        $this->variant['features'][] = [
            'id' => '',
            'value' => '',
            'description' => '',
        ];
    }
    public function feature_change($index)
    {
        $feature = Feature::find($this->variant['features'][$index]['id']);

        if ($feature) {
            $this->variant['features'][$index]['value'] = $feature->value;
            $this->variant['features'][$index]['description'] = $feature->description;
        }
    }
    public function removeFeature($index)
    {
        unset($this->variant['features'][$index]);
        $this->variant['features'] = array_values($this->variant['features']);
        $this->generarVariantes();
    }
    public function deleteFeature($option_id, $feature_id)
    {
        $this->product->options()->updateExistingPivot($option_id, [
            'features' => array_filter($this->product->options->find($option_id)->pivot->features, function ($feature) use ($feature_id) {
                return $feature['id'] != $feature_id;
            })
        ]);
        $this->product = $this->product->fresh();
        $this->generarVariantes();
    }
    public function deleteOption($option_id)
    {
        $this->product->options()->detach($option_id);
        $this->product = $this->product->fresh();
        $this->generarVariantes();
    }
    public function save()
    {
        $this->validate([
            'variant.option_id' => 'required',
            'variant.features.*.id' => 'required',
            'variant.features.*.value' => 'required',
        ], [], [
            'variant.option_id' => 'opción id',
            'variant.features.*.id' => 'id del valor',
            'variant.features.*.value' => 'valor',
        ]);

        $this->product->options()->attach($this->variant['option_id'], ['features' => $this->variant['features']]);
        $this->reset(['variant', 'openModal']);
        $this->generarVariantes();
    }
    public function generarVariantes()
    {
        $features = $this->product->options->pluck('pivot.features');
        $combinaciones = $this->generarCombinaciones($features->toArray());
        $this->product->variants()->delete();
        foreach ($combinaciones as $combinacion) {
            $variant = Variant::create(['product_id' => $this->product->id]);
            $variant->features()->attach($combinacion);
        }
        $this->dispatch('variant-generate');
    }
    public function generarCombinaciones(array $arrays, int $indice = 0, array $combinacion = []): array
    {
        if ($indice == count($arrays)) {
            return [$combinacion];
        }

        $resultado = [];
        foreach ($arrays[$indice] as $item) {
            $combinacionTemporal = $combinacion;                             // Creamos una copia de la combinación parcial
            $combinacionTemporal[] = $item['id'];                            // Añadimos el ID del elemento actual a la combinación temporal. 
            $resultado = array_merge($resultado, $this->generarCombinaciones(// 3. Llamada Recursiva: Avanzamos al siguiente array (índice + 1) 
                $arrays, $indice + 1, $combinacionTemporal
            ));
        }
        // 4. Devolvemos el array final de resultados.
        return $resultado;
    }
    public function render()
    {
        return view('livewire.admin.products.product-variants');
    }
}

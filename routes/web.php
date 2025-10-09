<?php

use App\Http\Controllers\FamilyController;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



Route::get('prueba',function(){
    $product = Product::find(150);
    $features =$product->options->pluck('pivot.features');
    $combinaciones =generarCombinaciones($features);
    foreach ($combinaciones as $combinacion) {
        $variant = Variant::create(['product_id'=>150]);
        $variant->features()->attach($combinacion);
    }
    return 'Variantes creadas';
});

function generarCombinaciones($arrays,$indice=0,$combinacion = []){
    if ($indice==count($arrays)) {
        return [$combinacion];
    }
    $resultado = [];
    foreach ($arrays[$indice] as $item) {
        $combinacionTemporal[]=$item['id'];
        $resultado = array_merge($resultado, generarCombinaciones($arrays,$indice+1,$combinacionTemporal));
    }
    return $resultado;
}
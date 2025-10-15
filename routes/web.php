<?php

use App\Http\Controllers\Admin\ShipmentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\WelcomeController; 
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class,'index'])->name('welcome.index');
Route::get('/families/{family}', [FamilyController::class,'show'])->name('families.show');
Route::get('/categories/{category}', [CategoryController::class,'show'])->name('categories.show');
Route::get('/subcategories/{subcategory}', [SubcategoryController::class,'show'])->name('subcategories.show');
Route::get('/products/{product}', [ProductController::class,'show'])->name('products.show');
Route::get('/cart', [CartController::class,'index'])->name('cart.index');
Route::get('shipping', [ShipmentController::class,'index'])->name('shipping.index');
Route::get('checkout', [CheckoutController::class,'index'])->name('checkout.index');


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
    Cart::instance('shopping');
    return Cart::content();
});

<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CoberController;
use App\Http\Controllers\Admin\CoverController;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\VariantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('families', FamilyController::class);
Route::resource('categories', CategoryController::class);
Route::resource('options', OptionController::class);
Route::resource('subcategories', SubcategoryController::class);
Route::resource('products', ProductController::class);

// Route::resource('products/{product}/variants/{variant}', [ProductController::class,'index'])
//         ->name('products.variants')->scopeBindings();
// Route::resource('products/{product}/variants/{variant}', [ProductController::class,'index'])
//         ->name('products.variantsUpdate')->scopeBindings();


Route::resource('covers', CoverController::class);

 

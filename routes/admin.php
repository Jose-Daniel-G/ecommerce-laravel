<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CoberController;
use App\Http\Controllers\Admin\CoverController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShipmentController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\VariantController;
use App\Http\Controllers\OrderController;
use App\Livewire\Admin\UserComponent;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})->middleware('can:access dashboard')->name('dashboard');//

Route::resource('families', FamilyController::class);
Route::resource('categories', CategoryController::class);
Route::resource('options', OptionController::class);
Route::resource('subcategories', SubcategoryController::class);
Route::resource('products', ProductController::class);
Route::get('products/{product}/variants/{variant}', [ProductController::class, 'variants'])
    ->name('products.variants')
    ->scopeBindings();
Route::put('products/{product}/variants/{variant}', [ProductController::class, 'variantsUpdate'])
    ->name('products.variantsUpdate')
    ->scopeBindings();

Route::get('/orders', [OrderController::class, 'index'])
     ->name('orders.index');
     
Route::get('/shipments', [ShipmentController::class,'index'])->name('shipments.index'); 

Route::resource('drivers', DriverController::class);
Route::resource('covers', CoverController::class);
Route::get('users', UserComponent::class)->name('admin.users.index');

// Route::resource('products/{product}/variants/{variant}', [ProductController::class,'index'])
//         ->name('products.variants')->scopeBindings();
// Route::resource('products/{product}/variants/{variant}', [ProductController::class,'index'])
//         ->name('products.variantsUpdate')->scopeBindings();

// Route::get('/', ShowProducts::class)->name('admin.index');
// Route::get('products/{product}/edit', EditProduct::class)->name('admin.products.edit');
// Route::post('products/{product}/files', [ProductController::class, 'files'])->name('admin.products.files');
// Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');
// Route::get('orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
// Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');
// Route::get('categories/{category}', ShowCategory::class)->name('admin.categories.show');
// Route::get('brands', BrandComponent::class)->name('admin.brands.index');
// Route::get('departments', DepartmentComponent::class)->name('admin.departments.index');
// Route::get('departments/{department}', ShowDepartment::class)->name('admin.departments.show');
// Route::get('cities/{city}', CityComponent::class)->name('admin.cities.show');

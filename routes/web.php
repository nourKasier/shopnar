<?php

use App\Livewire\Category\CategoryCreate;
use App\Livewire\Category\CategoryEdit;
use App\Livewire\Category\CategoryIndex;
use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Livewire\Product\ProductCreate;
use App\Livewire\Product\ProductEdit;
use App\Livewire\Product\ProductIndex;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
Route::get('/counter', Counter::class);




Route::middleware(['auth', 'role:admin|super-admin'])->group(function () {
    Route::get('/categories', CategoryIndex::class)->name('categories.index');
    Route::get('/categories/create', CategoryCreate::class)->name('categories.create');
    Route::post('/categories', [CategoryCreate::class, 'createCategory'])->name('categories.store');
    Route::get('/categories/{category}/edit', CategoryEdit::class)->name('categories.edit');
    Route::put('/categories/{category}', [CategoryEdit::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryIndex::class, 'deleteCategory'])->name('categories.destroy');

    //product routes
    Route::get('/products', ProductIndex::class)->name('products.index');
    Route::get('/products/create', ProductCreate::class)->name('products.create');
    Route::post('/products', [ProductCreate::class, 'createProduct'])->name('products.store');
    Route::get('/products/{product}/edit', ProductEdit::class)->name('products.edit');
    Route::put('/products/{product}', [ProductEdit::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{product}', [ProductIndex::class, 'deleteProduct'])->name('products.destroy');
});

<?php

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('business', [BusinessController::class, 'index'])->name('business.index');
    Route::get('business/create', [BusinessController::class, 'create'])->name('business.create');
    Route::post('business', [BusinessController::class, 'store'])->name('business.store');
    Route::get('business/{business}/edit', [BusinessController::class, 'edit'])->name('business.edit');
    Route::post('business/{business}', [BusinessController::class, 'update'])->name('business.update');
    Route::delete('business/{business}', [BusinessController::class, 'destroy'])->name('business.destroy');

    Route::get('product', [ProductController::class, 'index'])->name('product.index');
    Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('product', [ProductController::class, 'store'])->name('product.store');
    Route::get('product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('product/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
});

Route::get('{slug}', [BusinessController::class, 'shop'])->name('shop');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');




Route::get('/cart/{slug}', [CartController::class, 'index'])->name('cart.index');
//Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/finalizar', [CartController::class, 'finalizarPedido'])->name('finalizarPedido');
Route::delete('/carrito/{rowId}', [CartController::class, 'eliminarElemento'])->name('carrito.eliminar');
//Route::get('/pedidos', [CartController::class, 'pedidos'])->name('pedidos');
//Route::get('/pedidosShow/{id}', [CartController::class, 'pedidosShow'])->name('pedidosShow');
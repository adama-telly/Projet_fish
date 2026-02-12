<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ShopController::class, 'home']);

Route::get('/produits', [ShopController::class, 'index'])->name('products.index');
Route::get('/produits/{id}', [ShopController::class, 'show'])->name('products.show');
Route::post('/commander', [ShopController::class, 'createOrder'])->name('order.create');
Route::post('/commande/valider', [ShopController::class, 'submitOrder'])->name('order.submit');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

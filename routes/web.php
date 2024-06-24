<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/get_product', [ProductsController::class, 'retrieveOwnedProducts'])->name('get_product');
    Route::post('/add_product', [ProductsController::class, 'addProduct'])->name('add_product');
    Route::post('/edit_product', [ProductsController::class, 'editProduct'])->name('edit_product');
    Route::delete('/delete_product', [ProductsController::class, 'deleteProduct'])->name('delete_product');
    Route::get('/view_product_details', [ProductsController::class, 'viewProductDetails'])->name('view_product_details');
});

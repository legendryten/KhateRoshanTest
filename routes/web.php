<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [ProductController::class, 'showForm'])->name('product_form');
Route::post('/product', [ProductController::class, 'getProduct'])->name('product_info');
Route::get('/product/pdf', [ProductController::class, 'downloadPdf'])->name('product_pdf');

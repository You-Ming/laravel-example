<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;


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

/**
 * about
 * admin
 * banner
 * contact
 * news
 * product
 * productType
 * $route['news/page/(:any)'] = 'news/index/$1';
 * $route['news/page'] = 'news';
 * $route['news/(:any)'] = 'news/view/$1';
 * $route['news'] = 'news';
 * $route['product/(:any)/(:any)'] = 'product/view/$1/$2';
 * $route['product/(:any)'] = 'product/index/$1';
 * $route['product'] = 'product';
 * $route['contact'] = 'contact';
 */

Route::get('/', [HomeController::class, 'index']);

Route::resource('about', AboutController::class)->only(['index', 'show'])->parameters(['about' => 'title']);

Route::resource('news', NewsController::class)->only(['index', 'show']);

Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{type}', [ProductController::class, 'index']);
    Route::get('/{type}/{name}', [ProductController::class, 'show']);
});



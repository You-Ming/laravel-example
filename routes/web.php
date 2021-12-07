<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\NewsController;


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
 */

Route::get('/', [HomeController::class, 'index']);

Route::resource('about', AboutController::class)->only(['index', 'show'])->parameters(['about' => 'title']);

Route::resource('news', NewsController::class)->only(['index', 'show']);


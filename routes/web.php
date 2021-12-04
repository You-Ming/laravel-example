<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;


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
 */

Route::get('/', [HomeController::class, 'index']);

Route::resource('about', AboutController::class)->only(['index', 'show'])->parameters(['about' => 'title']);

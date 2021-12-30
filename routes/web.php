<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SigninController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProductTypeController as AdminProductTypeController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;


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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('about', AboutController::class)->only(['index', 'show'])->parameters(['about' => 'title']);

Route::resource('news', NewsController::class)->only(['index', 'show']);

Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{type}', [ProductController::class, 'index']);
    Route::get('/{type}/{name}', [ProductController::class, 'show']);
});

Route::view('contact', 'contact.index');
Route::post('ajax/contact', [ContactController::class, 'store']);

Route::view('sign_in', 'signin.index')->name('sign_in');
Route::view('login', 'signin.index')->name('login');
Route::post('ajax/signin', [SigninController::class, 'signin']);
Route::get('signout', [SigninController::class, 'signout']);




Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('welcome');
    Route::get('/log_out', [SigninController::class, 'signout'])->name('log_out');
    Route::resource('/home', AdminHomeController::class)->except('show');
    Route::get('/home/image/{home}/edit', [AdminHomeController::class, 'edit_image'])->name('home.image.edit');
    Route::put('/home/image/{home}', [AdminHomeController::class, 'update_image'])->name('home.image.update');
    Route::resource('/about', AdminAboutController::class)->except('show');
    Route::resource('/news', AdminNewsController::class)->except('show');
    Route::get('/news/search', [AdminNewsController::class, 'search'])->name('news.search');
    Route::resource('/product', AdminProductController::class)->except('show');
    Route::get('/product/image/{product}/edit', [AdminProductController::class, 'edit_image'])->name('product.image.edit');
    Route::put('/product/image/{product}', [AdminProductController::class, 'update_image'])->name('product.image.update');
    Route::get('/product/search', [AdminProductController::class, 'search'])->name('product.search');
    Route::resource('/product_type', AdminProductTypeController::class)->except('show');
    Route::get('/contact/search', [AdminContactController::class, 'search'])->name('contact.search');
    Route::resource('/contact', AdminContactController::class)->only(['index', 'show', 'destroy']);


});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\BlogController;
use App\Http\Controllers\User\ContactController;
use Whoops\Run;

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

//auth
Route::get('/login', [AuthController::class, 'formLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'formRegister'])->name('register.form');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::group(['prefix' => 'shop', 'as' => 'shop.'], function (){
    Route::get('/', [ShopController::class, 'index'])->name('index');
    Route::get('/{slug}', [ShopController::class, 'category'])->name('category');
    Route::get('/product/{slug}', [ShopController::class, 'detail'])->name('detail');
});

Route::group(['prefix' => 'cart', 'as' => 'cart.', 'middleware' => 'auth.user'], function(){
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::get('/count-cart', [CartController::class, 'getCount'])->name('count');
    Route::post('/add-to-cart', [CartController::class, 'add'])->name('add');
    Route::post('/update-quantity', [CartController::class, 'updateQuantity'])->name('update.quantity');
    Route::delete('/{id}', [CartController::class, 'delete'])->name('delete');

    Route::middleware('check.cart.empty')->group(function (){
        Route::get('/payment', [OrderController::class, 'index'])->name('payment');
        Route::post('/payment', [OrderController::class, 'store'])->name('payment.post');
    });
});

Route::group(['prefix' => 'blog', 'as' => 'blog.'], function (){
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogController::class, 'detail'])->name('detail');
});

Route::group(['prefix' => 'contact', 'as' => 'contact.'], function (){
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/', [ContactController::class, 'store'])->name('store');
});





<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ProfileController;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin/login', [AuthController::class, 'formLogin'])->name('admin.get.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.post.login');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::group(['prefix' => 'admin', 'middleware' => ['auth.admin'], 'as' => 'admin.'], function () {
    Route::get('/', [DashBoardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/{id}', [ProfileController::class, 'index'])->name('index');
        // Route::post('/', [ProductController::class, 'store'])->name('store');
        // Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        // Route::patch('/{id}', [ProductController::class, 'update'])->name('update');
        // Route::delete('/{id}', [ProductController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProductController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{id}', [CategoryController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{orderCode}', [OrderController::class, 'show'])->name('show');
        Route::post('/updateStatus', [OrderController::class, 'updateStatus'])->name('update.status');
    });

    Route::group(['prefix' => 'blogs', 'as' => 'blogs.'], function(){
        Route::get('/', [BlogController::class, 'index'])->name('index');
        Route::post('/', [BlogController::class, 'store'])->name('store');
        Route::get('/create', [BlogController::class, 'create'])->name('create');
        Route::post('/upload-ckeditor', [BlogController::class, 'uploadCkeditor'])->name('upload.ckeditor');
        Route::get('/{id}/edit', [BlogController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [BlogController::class, 'update'])->name('update');
        Route::delete('/{id}', [BlogController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'contacts', 'as' => 'contacts.'], function(){
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::get('/{id}', [ContactController::class, 'show'])->name('show');
        Route::post('/', [ContactController::class, 'store'])->name('store');
        Route::delete('/{id}', [ContactController::class, 'delete'])->name('delete');
    });
});

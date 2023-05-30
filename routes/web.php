<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;

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



Route::get('/dashboard', [DashboardController::class, 'index'])->name('home')->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'verifikasi'])->middleware('guest');

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'verify'])->middleware('guest');

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/product', [ProductController::class, 'index'])->name('product')->middleware('auth');
Route::get('/delcart/{userId}', [OrderController::class, 'deleteCart'])->middleware('auth');
Route::post('/deleteproduct', [OrderController::class, 'delete'])->middleware('auth');

Route::post('/order/{id}', [OrderController::class, 'index'])->middleware('auth');

Route::post('/checkout', [OrderController::class, 'checkout'])->middleware('auth');
Route::get('/checkout', [OrderController::class, 'index_checkout'])->middleware('auth');
Route::get('/checkout/method', [OrderController::class, 'method_id'])->middleware('auth');
Route::get('/checkout/method_id', [OrderController::class, 'getfees'])->middleware('auth');

Route::get('/cart', [OrderController::class, 'cart'])->middleware('auth');
Route::get('/invoice/{id}', [OrderController::class, 'invoice'])->middleware('auth');
Route::get('/user/transaction', [UserController::class, 'index'])->middleware('auth');

Route::get('/account', [AccountController::class, 'index'])->middleware('auth');
Route::get('/account/edit', [AccountController::class, 'editprofile'])->middleware('auth');
Route::post('/account/edit', [AccountController::class, 'edit'])->middleware('auth');

Route::get('/account/change_password', [AccountController::class, 'cpass'])->middleware('auth');
Route::post('/account/change_password', [AccountController::class, 'chpass'])->middleware('auth');

Route::post('/editorder/{id}', [OrderController::class, 'editCart'])->middleware('auth');

Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware('admin');

Route::get('/admin/order', [AdminController::class, 'active_order'])->middleware('admin');

Route::get('/admin/payment', [AdminController::class, 'payment'])->middleware('admin');
Route::post('/admin/payment', [AdminController::class, 'addpayment'])->middleware('admin');
Route::post('/admin/check_payment', [AdminController::class, 'check_payment'])->middleware('admin');
Route::post('/admin/edit_payment', [AdminController::class, 'edit_payment'])->middleware('admin');

Route::get('/admin/category', [AdminController::class, 'category'])->middleware('admin');
Route::post('/admin/category', [AdminController::class, 'addcategory'])->middleware('admin');
Route::post('/admin/edit_category', [AdminController::class, 'edit_category'])->middleware('admin');
Route::post('/admin/check_category', [AdminController::class, 'check_category'])->middleware('admin');
Route::post('/admin/delete_category', [AdminController::class, 'delete_category'])->middleware('admin');

Route::get('/admin/sub_category', [AdminController::class, 'subcategory'])->middleware('admin');
Route::post('/admin/sub_category', [AdminController::class, 'addsubcategory'])->middleware('admin');
Route::post('/admin/edit_subcategory', [AdminController::class, 'edit_subcategory'])->middleware('admin');
Route::post('/admin/check_subcategory', [AdminController::class, 'check_subcategory'])->middleware('admin');
Route::post('/admin/delete_subcategory', [AdminController::class, 'delete_subcategory'])->middleware('admin');
Route::get('/admin/product/subcat', [AdminController::class, 'subcat'])->middleware('admin');

Route::get('/admin/product', [AdminController::class, 'product'])->middleware('admin');
Route::post('/admin/product', [AdminController::class, 'addproduct'])->middleware('admin');
Route::post('/admin/edit_product', [AdminController::class, 'edit_product'])->middleware('admin');
Route::post('/admin/check_product', [AdminController::class, 'check_product'])->middleware('admin');
Route::post('/admin/delete_product', [AdminController::class, 'delete_product'])->middleware('admin');

Route::get('/admin/user', [AdminController::class, 'user'])->middleware('admin');
Route::post('/admin/user', [AdminController::class, 'adduser'])->middleware('admin');
Route::post('/admin/edit_user', [AdminController::class, 'edit_user'])->middleware('admin');
Route::post('/admin/check_user', [AdminController::class, 'check_user'])->middleware('admin');
Route::post('/admin/delete_user', [AdminController::class, 'delete_user'])->middleware('admin');

Route::get('/admin/transaction', [AdminController::class, 'transaction'])->middleware('admin');
Route::post('/admin/cancel_order', [AdminController::class, 'cancel_order'])->middleware('admin');
Route::post('/admin/confirm_order', [AdminController::class, 'confirm_order'])->middleware('admin');
Route::post('/admin/finish_order', [AdminController::class, 'finish_order'])->middleware('admin');
<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\customer\CartController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\OrderController;

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

Route::get('/',[FrontendController::class,'index'])->name('/');
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('product/{slug}',[FrontendController::class,'product_details'])->name('product_details');

Route::get('cart',[CartController::class,'cart'])->name('cart');
Route::get('cart/clear',[CartController::class,'cart_clear'])->name('cart.clear');
Route::get('checkout',[CartController::class,'checkout'])->name('checkout');
Route::get('thankyou',[OrderController::class,'thankyou'])->name('thankyou');

Route::post('add_to_wishlist',[CartController::class,'add_to_wishlist'])->name('add_to_wishlist');
Route::post('remove_from_wishlist',[CartController::class,'remove_from_wishlist'])->name('remove_from_wishlist');


Route::post('add_to_cart',[CartController::class,'add_to_cart'])->name('add_to_cart');
Route::get('get_cart_data',[CartController::class,'get_cart_data'])->name('get_cart_data');
Route::post('remove_from_cart',[CartController::class,'remove_from_cart'])->name('remove_from_cart');

Auth::routes(['verify' => true]);
Route::get('customer_register',[CustomerController::class,'customer_register'])->name('customer_register');
Route::get('customer_login',[CustomerController::class,'customer_login'])->name('customer_login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');


Route::group(['middleware' => ['auth','verified']],function(){
    Route::resource('categories',CategoryController::class);
    Route::resource('products',ProductController::class);

    Route::get('profile/{id}',[CustomerController::class,'profile'])->name('profile');
    Route::put('profile/{id}',[CustomerController::class,'update_profile'])->name('profile.update');
    Route::put('profile_image/{id}',[CustomerController::class,'profile_image'])->name('profile_image.update');

    Route::post('order_placed',[OrderController::class,'order_placed'])->name('order_placed');

    Route::get('orders',[OrderController::class,'index'])->name('orders.index');
    Route::get('order/{id}',[OrderController::class,'show'])->name('order.details');

    Route::get('change_order_status/{id}/{status}',[OrderController::class,'change_order_status'])->name('change_order_status');
});


View::composer('layouts.frontend',function($view){
    $cart_data = Cart::instance('cart');
    $wishlist_data = Cart::instance('wishlist')->content();
    return $view->with(['cart_data' => $cart_data,'wishlist' => $wishlist_data]);
});
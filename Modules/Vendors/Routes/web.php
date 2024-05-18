<?php

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

use Illuminate\Support\Facades\Route;
use Modules\Vendors\Livewire\Auth\Login;
use Modules\Vendors\Livewire\Auth\Register;
use Modules\Vendors\Livewire\Home\Home;
use Modules\Vendors\Livewire\LegalAffairs\Details;
use Modules\Vendors\Livewire\Orders\MyOrders;
use Modules\Vendors\Livewire\Products\ProductView;
use Modules\Vendors\Livewire\Products\StockProducts;
use Modules\Vendors\Livewire\VendoeAccount\Dashboard;
use Modules\Vendors\Livewire\VendoeAccount\Orders;
use Modules\Vendors\Livewire\Orders\Orderdetails;
use Modules\Vendors\Livewire\Products\ProductDetails;

Route::prefix('vendors')->group(function() {
    // Route::get('/home', Home::class);
    Route::get('/', 'VendorsController@index');
    Route::get('/home', [Home::class,'__invoke'])->name('vendor.home');
    Route::get('/Register', [Register::class,'__invoke'])->name('vendors.register');
    Route::get('/login', [Login::class,'__invoke'])->name('vendors.login');
    // Route::get('/login', [Login::class,'__invoke'])->name('login-register');

    //routes need auth
    Route::group(['middleware'=>['auth:companies'],'verified'], function () {
        Route::get('/myaccount', [Dashboard::class,'__invoke'])->name('myaccount');
        Route::get('/legall-affairs', [Details::class,'__invoke'])->name('legall-affairs');
        Route::get('/orders-state', [MyOrders::class,'__invoke'])->name('orders-state');
        Route::get('/myproducts', [ProductView::class,'__invoke'])->name('myproducts');
        Route::get('/product-details/{id}', [ProductDetails::class,'__invoke'])->name('product-details');
        Route::get('/stocks-products', [StockProducts::class,'__invoke'])->name('stocks-products');
        Route::get('/order-details/{id}', [Orderdetails::class,'__invoke'])->name('order-details');
    });

});




<?php

use Illuminate\Support\Facades\Route;
use Modules\Trader\Http\Controllers\TraderController;
use Modules\Trader\Http\Controllers\ShopController;
use Modules\Trader\Livewire\Home\Home;
use Modules\Trader\Livewire\User\Profile;
use Modules\Trader\Livewire\Shop\Shop;
use Modules\Trader\Livewire\ContactUs\ContactUs;
use Modules\Trader\Livewire\Blog\Blog;
use Modules\Trader\Livewire\Wishlist\Wishlist;
use Modules\Trader\Livewire\Auth\LoginSignup;
use Modules\Trader\Livewire\Compare\Compare;
use Modules\Trader\Livewire\Products\Products;
use Modules\Trader\Livewire\Shop\ShopList;
use Modules\Trader\Livewire\Blog\SingleBlog;
use Modules\Trader\Livewire\Categories\Categories;
use Modules\Trader\Livewire\TraderAccount\Dashboard;
use Modules\Trader\Livewire\Search\Search;
use Modules\Trader\Livewire\Cart\Cartpage;
use Modules\Trader\Livewire\Cart\Checkout;
use Modules\Trader\Livewire\Cart\CompleteOrder;
use Modules\Trader\Livewire\Home\TopRated;
use Modules\Trader\Livewire\Manufacturer\Manufacturer;
use Modules\Trader\Livewire\Freelancers\Freelancer;
use Modules\Trader\Livewire\Shop\Bestselling;
use Modules\Trader\Livewire\Shop\Mostpopular;
use Modules\Trader\Livewire\Shop\Newarrival;
use Modules\Trader\Livewire\Search\Searchvendor;
use Modules\Trader\Livewire\TraderAccount\Orders;
use Modules\Trader\Livewire\TraderAccount\Track;
use Modules\Trader\Livewire\About\About;

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
Route::get('/', [Home::class,'__invoke'])->name('home');

Route::prefix('trader')->as('trader.')->group(function() {
    // Route::get('/', [H::class,'index']);
    Route::get('/showlogin', [LoginSignup::class,'__invoke'])->name('loginastrader');
    Route::get('/shop/{vendor_id}',[Shop::class,'__invoke'])->name('shop');
    Route::get('/profile', [Profile::class,'__invoke'])->name('profile');
    Route::get('/contact-us', [ContactUs::class,'__invoke'])->name('contactus');
    Route::get('/blog', [Blog::class,'__invoke'])->name('blog');
    Route::get('/single-blog/{blog_id}', [SingleBlog::class,'__invoke'])->name('single-blog');
    Route::get('/wishlist', [Wishlist::class,'__invoke'])->name('wishlist');
    Route::get('/compare', [Compare::class,'__invoke'])->name('compare');
    Route::get('/products/{product_id}', [Products::class,'__invoke'])->name('product');
    Route::get('/categories/{category_id}', [Categories::class,'__invoke'])->name('category');
    Route::get('/account',[Dashboard::class,'__invoke'])->name('account');
    Route::get('/search/{param1}/{param2}',[Search::class,'__invoke'])->name('search');
    // Route::get('/cart',[ShowCart::class,'__invoke'])->name('cart');
    Route::get('/shop-list',[Shop::class,'__invoke'])->name('shop-list');
    Route::get('/cart',[Cartpage::class,'__invoke'])->name('cart');
    Route::get('/checkout',[Checkout::class,'__invoke'])->name('checkout');
    Route::get('/order',[CompleteOrder::class,'__invoke'])->name('order');
    Route::get('/top_rated', [TopRated::class,'__invoke'])->name('top_rated');
    Route::get('/manufacturer', [Manufacturer::class,'__invoke'])->name('manufacturer');
    Route::get('/freelancer', [Freelancer::class,'__invoke'])->name('freelancer');
    Route::get('/bestselling', [Bestselling::class,'__invoke'])->name('bestselling');
    Route::get('/mostpopular', [Mostpopular::class,'__invoke'])->name('mostpopular');
    Route::get('/newarrival', [Newarrival::class,'__invoke'])->name('newarrival');
    Route::get('/searchvendor{param1}/{param2}', [Searchvendor::class,'__invoke'])->name('searchvendor');
    Route::get('/vieworder/{id}', [Orders::class,'__invoke'])->name('vieworder');
    Route::get('/privacy/{slug}', [About::class,'__invoke'])->name('privacy');

    Route::get('/track/{id}', [Track::class,'__invoke'])->name('track');

});
// ;
// Route::prefix('trader')->middleware(['redirectIfAuthenticated'])->group(function() {
//     Route::get('/showregister', 'TraderController@index2')->name('registerastrader');

//     Route::post('/login',[TraderController::class,'compare'])->name('login.trader');
//     Route::post('/register/store',[TraderController::class,'store'])->name('register.trader');

// });

// Route::prefix('trader')->middleware(['trader'])->group(function() {
//     Route::get('dashboard',[TraderController::class,'show'])->name('dashboard.index');
//     Route::get('logoute',[TraderController::class,'logout'])->name('logoute');

// });

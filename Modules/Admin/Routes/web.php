<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\MailController;
use App\Models\User;
use Modules\Admin\Livewire\Admin\Categories\Categories;
use Modules\Admin\Livewire\Admin\Categories\Edit;
use Modules\Admin\Livewire\Test\Asd1;
use Modules\Admin\Livewire\Test\Asd2;
use App\Http\Controllers\Admin\PagesMnuController;
use Modules\Admin\Http\Controllers\Admin\SettingMsController;
use Modules\Admin\Http\Controllers\Admin\StaticPageController;
use App\Http\Controllers\Admin\SubscribeMailsController;
use App\Http\Controllers\LanguageController;
use Modules\Admin\Livewire\Admin\Users\Users;
use Modules\Admin\Livewire\About;
use Modules\Admin\Livewire\Admin\Advertisings\Advertisings;
use Modules\Admin\Livewire\Admin\ArtMins\ArtMins;
use Modules\Admin\Livewire\Admin\Attributes\Attributes;
use Modules\Admin\Livewire\Admin\AttributeValues\AttributeValues;
use Modules\Admin\Livewire\Admin\ContactServices\ContactServices;
use Modules\Admin\Livewire\Admin\CountriesCities\CountriesCities;
use Modules\Admin\Livewire\Admin\Gallaries\Gallaries;
use Modules\Admin\Livewire\Admin\Home;
use App\Http\Livewire\Admin\Notifications\Notifications as AdminNotifications;
use Modules\Admin\Livewire\Admin\Orders\DeliveredOrders;
use Modules\Admin\Livewire\Admin\Orders\DeliveringOrders;
use Modules\Admin\Livewire\Admin\Orders\FinshedOrders;
use Modules\Admin\Livewire\Admin\Orders\NewOrders;
use Modules\Admin\Livewire\Admin\Orders\WorkingOrders;
use Modules\Admin\Livewire\Admin\ProductAttributes\ProductAttributes;
use Modules\Admin\Livewire\Admin\ProductOrders\ProductOrders;
use Modules\Admin\Livewire\Admin\Products\Products;
use App\Http\Livewire\Admin\Products\Sizes as ProductsSizes;
use App\Http\Livewire\Admin\Rates\Rates;
use Modules\Admin\Livewire\Admin\Sizes\Sizes;
use App\Http\Livewire\Admin\SmsHistories\SmsHistories;
use Modules\Admin\Livewire\Admin\SocialMedias\SocialMedias;
use App\Http\Livewire\Admin\SpecialSettings\SpecialSettings;
use App\Http\Livewire\Admin\Stores\Stores;
use App\Http\Livewire\Admin\UserProducts\UserProducts;
use App\Http\Livewire\Admin\Users\UpdateProfile;
use App\Http\Livewire\Admin\UsersRequests;
use App\Http\Livewire\ContactUs;
use App\Http\Livewire\Notifications\Notifications;
use App\Http\Livewire\Site\About as SiteAbout;
use App\Http\Livewire\Site\AddProduct;
use App\Http\Livewire\Site\Auth\Login;
use App\Http\Livewire\Site\Auth\Register;
use Modules\Admin\Livewire\Site\CategoryProducts;
use App\Http\Livewire\Site\Home\Home as SiteHome;
use App\Http\Livewire\Site\Layouts\Footer;
use App\Http\Livewire\Site\Payment;
use App\Http\Livewire\Site\Products\ProductDetails;
use App\Http\Livewire\Site\ProductInfo;
use App\Http\Livewire\Site\Profile;
use Modules\Admin\Livewire\Site\SubCategoryProducts;
use App\Http\Livewire\Site\Products\SubProducts;
use Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm;
use Modules\Admin\Livewire\Admin\Coupons\Coupons;
use Modules\Admin\Livewire\Admin\Orders\CanceledOrders;
use App\Http\Livewire\Admin\SubscribeMails\SubscribeMails;
use App\Http\Livewire\Site\Favourites;
use Illuminate\Support\Facades\Auth;

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


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
// Route::prefix('admin')->group(function() {
//     Route::get('/', 'AdminController@index');
// });
Route::group(['prefix'=>'A_ms_admin'], function () {
    /*
    routes for Admin
    */
    //Route::get('admin-login', 'Auth\LoginController');
    Route::get('admin-login', [LoginController::class,'showLoginForm'])->name('admin.login');
    Route::post('admin-login', [LoginController::class,'login']);//->middleware("throttle:2,1");
    Route::post('admin-logout', [LoginController::class,'logout'])->name('admin.logout');

    Route::group(['middleware'=>'auth:admin','verified'], function () {
        //admin home['middleware' => ['auth:admin']],
        Route::get('/', [Home::class,'__invoke'])->name('A_ms_admin');
        // Route::get('home',[Home::class,'__invoke'])->name('A_ms_admin');

        //admin page_mnu
        // Route::resource('pages_mnu',PagesMnuController::class);
        // Route::get('pages_mnu/t/{p_id}', [PagesMnuController::class,'index'])->name('pages_mnu.t');
        // Route::put('pages_mnu/active_ms/{id}',[PagesMnuController::class,'active_ms'])->name('pages_mnu.active_ms');
        // Route::resource('static_pages',StaticPageController::class);
        // Route::resource('setting-page', SettingMsController::class);
        // Route::resource('contact-messages', ContactUsController::class);
        // Route::resource('setting_app', SettingAppController::class);
        // Route::get('/setting_app/{id}', [SettingAppController::class, 'show']);
        // // ---------- livewires routes ----------------
        // Route::get('social-media',SocialMedias::class);
        // Route::get('sms-histories',SmsHistories::class);
        // Route::get('app-versions',AppVersions::class);

        //admin home
        // Route::post('/change-language',[LanguageController::class,'change'])->name('change.language');

        //admin page_mnu
        Route::resource('pages_mnu',PagesMnuController::class);
        Route::get('pages_mnu/t/{p_id}', [PagesMnuController::class,'index'])->name('pages_mnu.t');
        Route::put('pages_mnu/active_ms/{id}',[PagesMnuController::class,'active_ms'])->name('pages_mnu.active_ms');
        Route::resource('static_pages',StaticPageController::class);
        Route::resource('setting-page', SettingMsController::class);
        Route::resource('contact-messages', ContactUsController::class);
        // ---------- livewires routes ----------------
        Route::get('social-media',[SocialMedias::class,'__invoke']);
        // Route::get('sms-histories',SmsHistories::class);
        // Route::get('users/{type}/{role_id}',Users::class);
        // Route::get('users/profile',UpdateProfile::class);
        Route::get('category/{type}/{parent_id}' , [Categories::class,'__invoke'])->name('category');
        // Route::get('category/{type}/{parent_id}' , [Edit::class,'__invoke']);
        // Route::get('notifications/{type}/{with_id}' , AdminNotifications::class);
        Route::get('countries_cities/{parent_id}' , [CountriesCities::class,'__invoke']);
        Route::get('art-mins/{type}/{category_id}',[ArtMins::class,'__invoke'])->name('art-mins');
        // Route::get('subscribe-mails',SubscribeMails::class);
        // Route::get('stores',Stores::class)->name('stores');
        Route::get('products',[Products::class,'__invoke'])->name('products');
        Route::get('product_attributes/{product_id}',[ProductAttributes::class,'__invoke'])->name('product_attributes');
        // Route::get('users-requests',UsersRequests::class);
        // Route::get('advertisings/{type}/{with_id}' , Advertisings::class);
        // Route::get('rates/{question_id}',Rates::class);
        // Route::get('/contact-services', ContactServices::class)->name('contact-services');
        // Route::get('/contact-us', ContactUsContactUs::class)->name('contact-us');
        // Route::get('/SpecialSetting', SpecialSettings::class);
        Route::get('gallery/{type}',[Gallaries::class,'__invoke']);
        Route::get('new-orders',[NewOrders::class,'__invoke']);
        Route::get('working-orders',[WorkingOrders::class,'__invoke']);
        Route::get('delivering-orders',[DeliveringOrders::class,'__invoke']);
        Route::get('delivered-orders',[DeliveredOrders::class,'__invoke']);
        Route::get('finshed-orders',[FinshedOrders::class,'__invoke']);
        Route::get('canceled-orders',[CanceledOrders::class,'__invoke']);
        Route::get('product-users',[ProductOrders::class,'__invoke']);
        // Route::get('user-products',UserProducts::class);
        Route::get('products-sizes/{id}',[ProductsSizes::class,'__invoke'])->name('products_sizes');

        // //admin attribute
        Route::get('/attribute/t/{type}', [Attributes::class,'__invoke'])->name('attribute.t');
        // //admin attribute_values
        Route::get('/attribute_values/t/{attribute_id}',[ AttributeValues::class,'__invoke'])->name('attribute_values.t');

        // //admin notifications
        // Route::resource('/notifications',NotificationsController::class);
        // Route::get('/notifications/t/{typ}/{with_id}',[NotificationsController::class,'index'] )->name('notifications.t');
        // Route::put('/notifications/active_ms/{id}',[NotificationsController::class,'active_ms'] )->name('notifications.active_ms');
        Route::get('coupons',[Coupons::class,'__invoke']);
        // // --------- End Livewires routes -------------
    });
});
Route::get('locale/{locale}', function ($locale){
    $upd_usr=User::find(Auth::user()->id);
    $upd_usr->user_lang=$locale;
    $upd_usr->save();
    Session::put('locale', $locale);
    return redirect()->back();
})->name('auth.lang')->middleware('auth:admin');

// Route::get('locale',[LanguageController::class,'index'])->name('getlang');
Route::get('lang/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
})->name('lang');
// ---------- livewires site routes ----------------




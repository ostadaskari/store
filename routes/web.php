<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductSEOController;
use App\Http\Controllers\Admin\ShippingController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;

use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CartCouponController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\CategoryController as FrontCategoryController;
use App\Http\Controllers\Front\LocationController;
use App\Http\Controllers\Front\ProductController as FrontProductController;
use App\Http\Controllers\Front\UserAddressController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserInvoiceController;
use App\Http\Controllers\User\UserOrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\PriceController;

Route::middleware('user')->group(callback: function(){
    Route::get('/user/dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/orders', [UserOrderController::class, 'orders'])->name('user.orders');
    // Main invoices page (user.invoices)
    Route::get('/user/invoices', [UserInvoiceController::class, 'index'])->name('user.invoices');
    // AJAX endpoint for fetching/searching/paginating invoices
    Route::get('/user/invoices/fetch', [UserInvoiceController::class, 'fetchInvoices'])->name('user.invoices.fetch');

    Route::get('/user/profile', [ProfileController::class, 'index'])->name('user.profile');
    // Route for updating personal info (Form 1)
    Route::post('/user/profile/update-info', [ProfileController::class, 'updateProfile'])
        ->name('user.profile.updateProfile');

    // Route for updating bank info (Form 2)
    Route::post('/user/profile/update-bank', [ProfileController::class, 'updateBankInfo'])
        ->name('user.profile.updateBankInfo');

    // Route for changing password (Form 3)
    Route::post('/user/profile/update-password', [ProfileController::class, 'updatePassword'])
        ->name('user.profile.updatePassword');

});

Route::middleware('admin')->group(callback: function(){

    Route::get('/admin/dashboard',[DashboardController::class,'dashboard']);
    Route::get('/admin/dashboard/chart-data', [DashboardController::class, 'chartData'])
        ->name('admin.dashboard.chart');


    Route::get('/admin/admin/list',[AdminController::class,'list']);
    Route::get('/admin/admin/add',[AdminController::class,'add']);
    Route::post('/admin/admin/add',[AdminController::class,'insert']);

    Route::get('/admin/admin/edit/{id}',[AdminController::class,'edit']);
    Route::post('/admin/admin/edit/{id}',[AdminController::class,'update']);
    Route::get('/admin/admin/delete/{id}',[AdminController::class,'delete']);

    Route::get('/admin/category/list',[CategoryController::class,'index']);
    Route::get('/admin/category/flat', [CategoryController::class, 'indexFlat']);

    Route::get('/admin/product/list',[ProductController::class,'index']);

    Route::get('/admin/banners', [BannerController::class, 'index'])->name('banners.index');
    Route::post('/admin/banners', [BannerController::class, 'store'])->name('banners.store');
    Route::delete('/admin/banners/{id}', [BannerController::class, 'destroy'])->name('banners.destroy');
    Route::post('/admin/banners/order', [BannerController::class, 'updateOrder'])->name('banners.updateOrder');

    Route::get('/admin/product-seo', [ProductSEOController::class,'index'])->name('product_seo.index');
    Route::post('/admin/product-seo/save', [ProductSEOController::class, 'storeOrUpdate'])->name('product_seo.save');

    Route::get('/admin/prices', [PriceController::class, 'index'])->name('admin.prices.index');
    Route::post('/admin/prices/settings', [PriceController::class, 'saveSettings'])->name('admin.prices.saveSettings');
    Route::post('/admin/prices/save', [PriceController::class, 'saveProductPrice'])->name('admin.prices.saveProduct');

    Route::get('/admin/discounts/search', [DiscountController::class, 'ajaxSearch'])->name('admin.discounts.ajaxSearch');
    Route::resource('/admin/discounts', DiscountController::class)
        ->names('admin.discounts');

    Route::get('/admin/shippings', [ShippingController::class, 'index'])->name('admin.shippings.index');
    Route::post('/admin/shippings', [ShippingController::class, 'store'])->name('admin.shippings.store'); // create
    Route::put('/admin/shippings/{shipping}', [ShippingController::class, 'update'])->name('admin.shippings.update'); // update
    Route::delete('/admin/shippings/{shipping}', [ShippingController::class, 'destroy'])->name('admin.shippings.destroy'); // soft delete
    Route::post('/admin/shippings/{shipping}/toggle-status', [ShippingController::class, 'toggleStatus'])->name('admin.shippings.toggleStatus');

    Route::get('/admin/orders', [OrderController::class, 'list'])->name('admin.orders.list');
    Route::get('/admin/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
    // New route for AJAX status update
    Route::post('admin/orders/update-status', [OrderController::class, 'updateStatus'])->name('admin.orders.update.status');

    Route::get('admin/customers',[CustomerController::class,'list'])->name('admin.customers.list');
    Route::get('admin/customers/{userId}/addresses', [CustomerController::class, 'showAddresses'])->name('admin.customers.addresses');
    Route::get('/admin/customers/delete/{id}',[CustomerController::class,'delete'])->name('admin.customers.delete');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/category/{slug}',[FrontCategoryController::class,'show'])->name('category.show');

// AJAX update route (must be OUTSIDE prefix!)
Route::post('/cart/ajax/update/{id}', [CartController::class, 'ajaxUpdate'])
    ->name('cart.ajax.update');
Route::post('/cart/ajax/remove/{id}', [CartController::class, 'ajaxRemove'])
    ->name('cart.ajax.remove');

// Normal cart routes
Route::prefix('cart')->group(function () {

    Route::post('/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/clear', [CartController::class, 'clear'])->name('cart.clear');


    // apply discount on Cart
    Route::post('/coupon/apply', [CartCouponController::class, 'apply'])->name('cart.coupon.apply');
    Route::post('/coupon/remove', [CartCouponController::class, 'remove'])->name('cart.coupon.remove');

});
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('checkout/place_order', [CartController::class, 'place_order'])->name('checkout.place_order');
Route::get('checkout/payment', [CartController::class, 'checkout_payment']);
// GET request to fetch all saved addresses (Used by loadUserAddresses in JS)
Route::get('/user/addresses', [UserAddressController::class, 'index'])
    ->name('user.addresses.index');

// POST request to save a new address (Used by saveAddressBtn in JS)
Route::post('/user/addresses', [UserAddressController::class, 'store'])
    ->name('user.address.store');
Route::put('/user/addresses/{address}', [UserAddressController::class, 'update'])
    ->name('user.address.update');
Route::delete('/user/addresses/{address}', [UserAddressController::class, 'destroy'])
    ->name('user.address.destroy');
// --- API Route for Iran Locations ---
// این مسیر توسط جاوا اسکریپت در صفحه تسویه حساب برای پر کردن دراپ‌داون استان/شهر استفاده می‌شود.
Route::get('/api/iran/locations', [LocationController::class, 'getIranLocations'])->name('api.iran.locations');

// admin authentication
Route::get('/admin',[AuthController::class,'login_admin']);
Route::post('/admin',[AuthController::class,'auth_login_admin']);
Route::get('/admin/logout',[AuthController::class,'logout_admin']);


// Front Authentication Routes (Only accessible when NOT logged in)
Route::middleware('guest')->group(function () {

    // front authentication (Registration Flow)
    // 1. Initial Mobile Input & Sending OTP
    Route::get('/register', [RegisterController::class, 'showMobileForm'])->name('client.register.mobile.form');
    Route::post('/register/send-code', [RegisterController::class, 'sendVerificationCode'])->name('client.register.send.code');
    Route::get('/register/reset', [RegisterController::class, 'resetMobile'])->name('client.register.reset.mobile');

    // 2. Verify OTP Code
    Route::post('/register/verify-code', [RegisterController::class, 'verifyCode'])->name('client.register.verify.code');

    // 3. Final Registration Form (after successful verification)
    Route::get('/register/complete', [RegisterController::class, 'showRegistrationForm'])->name('client.register.final.form');
    Route::post('/register/complete', [RegisterController::class, 'finalRegister'])->name('client.register');


    // front authentication (Login Flow - Mobile OTP)
    Route::get('/login', [LoginController::class, 'showMobileForm'])->name('client.login.mobile.form');
    Route::post('/login/send-code', [LoginController::class, 'sendVerificationCode'])->name('client.login.send.code');
    Route::post('/login/verify-code', [LoginController::class, 'verifyCode'])->name('client.login.verify.code');

    // NEW: Standard Email/Password/Username Login
    Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('client.login.authenticate');


    // for OAth with Google
    Route::get('auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);
});

// Route definitions needed for the new flow
Route::get('/social-complete-mobile', [LoginController::class, 'showMobileRegistrationForSocial'])->name('client.social.complete.mobile');
Route::post('/social-send-code', [LoginController::class, 'sendSocialMobileCode'])->name('client.social.send.code');
Route::post('/social-verify-code', [LoginController::class, 'completeSocialRegistration'])->name('client.social.verify.code');

// Logout Route (Only accessible when logged in)
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('client.logout');


Route::get('product/{category:slug}/{product:slug}', [FrontProductController::class, 'show'])->name('front.product.show');

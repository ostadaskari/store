<?php

use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\ProductSEOController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CartCouponController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\CategoryController as FrontCategoryController;
use App\Http\Controllers\Front\ProductController as FrontProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\PriceController;


Route::middleware('admin')->group(callback: function(){

    Route::get('/admin/dashboard',[DashboardController::class,'dashboard']);

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
    Route::post('/admin/product-seo/save', [ProductSEOController::class,'storeOrUpdate'])->name('product_seo.save');

    Route::get('/admin/prices', [PriceController::class, 'index'])->name('admin.prices.index');
    Route::post('/admin/prices/settings', [PriceController::class, 'saveSettings'])->name('admin.prices.saveSettings');
    Route::post('/admin/prices/save', [PriceController::class, 'saveProductPrice'])->name('admin.prices.saveProduct');

    Route::get('/admin/discounts/search', [DiscountController::class, 'ajaxSearch'])->name('admin.discounts.ajaxSearch');
    Route::resource('/admin/discounts', DiscountController::class)
        ->names('admin.discounts');

});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/category/{slug}',[FrontCategoryController::class,'show'])->name('category.show');

// AJAX update route (must be OUTSIDE prefix!)
Route::post('/cart/ajax/update/{id}', [CartController::class, 'ajaxUpdate'])
    ->name('cart.ajax.update');

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



Route::get('/admin',[AuthController::class,'login_admin']);
Route::post('/admin',[AuthController::class,'auth_login_admin']);
Route::get('/admin/logout',[AuthController::class,'logout_admin']);

//for OAth with Google
Route::get('auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);
Route::get('product/{category:slug}/{product:slug}', [FrontProductController::class, 'show'])->name('front.product.show');



<?php

use App\Http\Controllers\BO\AdminController;
use App\Http\Controllers\BO\AuthController;
use App\Http\Controllers\BO\BlogCategoryController;
use App\Http\Controllers\BO\BlogController;
use App\Http\Controllers\BO\CompatibleController;
use App\Http\Controllers\BO\CustomerController;
use App\Http\Controllers\BO\DashboarController;
use App\Http\Controllers\BO\FeatureController;
use App\Http\Controllers\BO\LicenseController;
use App\Http\Controllers\BO\PayoutController;
use App\Http\Controllers\BO\ProductCategoryController;
use App\Http\Controllers\BO\ProductController;
use App\Http\Controllers\BO\ProductTrashedController;
use App\Http\Controllers\BO\ProfileController;
use App\Http\Controllers\BO\SellerController;
use App\Http\Controllers\Bo\SettingController;
use App\Http\Controllers\BO\ToolController;
use App\Http\Controllers\BO\WalletController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::prefix("/back-office")->name("bo.")->group(function(){
  // auth route
  Route::get("/kulonuwon", [AuthController::class, "login"])->name("login.index");
  Route::post("/kulonuwon", [AuthController::class, "loginProcess"])->name("login.store");
  Route::post("/kulonuwon/logout", [AuthController::class, "logout"])->name("login.logout");
  // end auth route
  
  Route::middleware("auth:admin")->group(function(){
    Route::middleware(["back-office"])->group(function(){
      Route::get("/dashboard", [DashboarController::class, "index"])->name("dashboard");
      
      // route main menu
        Route::resource("/products", ProductController::class);
        Route::post("/products/product-images", [ProductController::class, 'storeProductImage'])->name("products.images.store");
        Route::post("/products/product-images/{id}", [ProductController::class, 'destroyProductImage'])->name("products.images.destroy");
        Route::resource("/products-trashed", ProductTrashedController::class);
        Route::resource("/blogs", BlogController::class);
        Route::resource("/payouts", PayoutController::class);
        Route::resource("/wallets", WalletController::class);
      // end route main menu
      
    });
    
    Route::middleware("administrator")->group(function(){
      // route data master
        Route::resource("/product-categories", ProductCategoryController::class);
        Route::resource("/blog-categories", BlogCategoryController::class);
        Route::resource("/compatibles", CompatibleController::class);
        Route::resource("/features", FeatureController::class);
        Route::resource("/licenses", LicenseController::class);
        Route::resource("/tools", ToolController::class);
      // end route data master
  
      // route config menu
        Route::resource("/customers", CustomerController::class);
        Route::resource("/sellers", SellerController::class);
        Route::resource("/admins", AdminController::class);
        Route::resource("/settings", SettingController::class);
        Route::resource("/profiles", ProfileController::class);
      // end route config menu
    });
  });
});

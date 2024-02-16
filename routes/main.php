<?php

use App\Http\Controllers\Main\BlogController;
use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Main\LicenseController;
use App\Http\Controllers\Main\ProductController;
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

Route::name("fe.")->group(function(){
  Route::get("/", [HomeController::class, 'index'])->name("home.index");
  
  Route::get("/products/{slug}", [ProductController::class, 'show'])->name("products.show");
  
  Route::get("/licenses", [LicenseController::class, 'index'])->name("licenses.show");

  Route::get("/blogs", [BlogController::class, 'index'])->name("blogs.index");

});
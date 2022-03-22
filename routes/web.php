<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\MultiPicController;

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
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/', function () {
    return view('welcome');
});
// Dashboard
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $users=User::all();
    return view('dashboard',compact("users"));
})->name('dashboard');

// Category
Route::resource('categories', CategoryController::class);
Route::get('/categories/soft-delete/{id}',[CategoryController::class,"softDelete"] );
Route::get('/categories/restore/{id}',[CategoryController::class,"restore"] );
Route::get('/categories/permanent-delete/{id}',[CategoryController::class,"permanentDelete"] );

// Category
Route::resource('brands', BrandController::class);
Route::get('brands/{id}/delete', [BrandController::class,"deleteBrand"]);
Route::resource('multi-pic', MultiPicController::class);
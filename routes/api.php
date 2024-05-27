<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FuelsController;
use App\Http\Controllers\ModelsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::resource('brands', BrandController::class)->except('store');
Route::post('brands', [BrandController::class ,'store']);
Route::resource('categories', CategoriesController::class);
Route::resource('fuels', FuelsController::class);
Route::resource('models', ModelsController::class);

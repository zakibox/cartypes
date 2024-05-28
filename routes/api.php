<?php

use App\Http\Controllers\brandController;
use App\Http\Controllers\categoriesController;
use App\Http\Controllers\fuelsController;
use App\Http\Controllers\ModelController; 
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

Route::resource('brands', brandController::class)->except('store');
Route::post('brands', [brandController::class, 'store']);
Route::resource('categories', categoriesController::class);
Route::resource('fuels', fuelsController::class);
Route::resource('models', ModelController::class);

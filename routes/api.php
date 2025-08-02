<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;

Route::apiResource('countries', CountryController::class);
Route::apiResource('states', StateController::class)->except(['index']);
Route::apiResource('cities', CityController::class)->except(['index']);

// Additional routes for dynamic dropdowns
Route::get('states', [StateController::class, 'index']); // ?country_id=1
Route::get('cities', [CityController::class, 'index']);  // ?state_id=1

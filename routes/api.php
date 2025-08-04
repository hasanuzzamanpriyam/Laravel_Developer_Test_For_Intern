<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;

/*
|--------------------------------------------------------------------------
| API Routes for Country-State-City CRUD
|--------------------------------------------------------------------------
*/

Route::apiResource('countries', CountryController::class);

// State CRUD (nested under countries, but also accessible directly)
Route::apiResource('states', StateController::class);

// City CRUD (nested under states, but also accessible directly)
Route::apiResource('cities', CityController::class);


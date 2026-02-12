<?php

use App\Http\Controllers\ListingsController;
use Illuminate\Support\Facades\Route;
//get all listings
Route::get('/', [ListingsController::class, 'index']);

//create listing (display form to create listing)
Route::get('/listings/create', [ListingsController::class, 'create']);

//store listing data(submit form data)
Route::post('/listings', [ListingsController::class, 'store']);

//show single listing
Route::get('/listings/{listing}', [ListingsController::class, 'show']);



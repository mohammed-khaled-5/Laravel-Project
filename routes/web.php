<?php

use App\Http\Controllers\ListingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ListingsController::class, 'index']);


Route::get('/listings/{listing}', [ListingsController::class, 'show']);

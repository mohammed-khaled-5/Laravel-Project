<?php

use App\Http\Controllers\ListingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
//get all listings
Route::get('/', [ListingsController::class, 'index']);

//create listing (display form to create listing)
Route::get('/listings/create', [ListingsController::class, 'create']);

//store listing data(submit form data)
Route::post('/listings', [ListingsController::class, 'store']);

//show edit form
Route::get('/listings/{listing}/edit', [ListingsController::class, 'edit']);

//update listing data
Route::put('/listings/{listing}', [ListingsController::class, 'update']);

//delete listing
Route::delete('/listings/{listing}', [ListingsController::class, 'destroy']);

//show single listing
Route::get('/listings/{listing}', [ListingsController::class, 'show']);

//show register form
Route::get('/register', [UserController::class, 'create']);

//create new user (submit registration form)
Route::post('/users', [UserController::class, 'store']);

//logout user
Route::post('/logout', [UserController::class, 'logout']);

//show login form
Route::get('/login', [UserController::class, 'login']);

//login user
Route::post('/login', [UserController::class, 'authenticate']);



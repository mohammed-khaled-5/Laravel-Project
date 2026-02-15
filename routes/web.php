<?php

use App\Http\Controllers\ListingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
//get all listings
Route::get('/', [ListingsController::class, 'index']);

//create listing (display form to create listing)
Route::get('/listings/create', [ListingsController::class, 'create'])->middleware('auth');

//store listing data(submit form data)
Route::post('/listings', [ListingsController::class, 'store'])->middleware('auth');

//manage listings
Route::get('/listings/manage', [ListingsController::class, 'manage'])->middleware('auth');

//show edit form
Route::get('/listings/{listing}/edit', [ListingsController::class, 'edit'])->middleware('auth');

//update listing data
Route::put('/listings/{listing}', [ListingsController::class, 'update'])->middleware('auth');

//delete listing
Route::delete('/listings/{listing}', [ListingsController::class, 'destroy'])->middleware('auth');

//show single listing
Route::get('/listings/{listing}', [ListingsController::class, 'show']);

//show register form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//create new user (submit registration form)
Route::post('/users', [UserController::class, 'store']);

//logout user
Route::post('/logout', [UserController::class, 'logout']);

//show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//login user
Route::post('/users/authenticate', [UserController::class, 'authenticate'])->name('login');


<?php

use App\Http\Controllers\ListingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Auth\PasswordResetController;

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

//Show the "Forgot Password" form
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

//Handle the email submission
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])
    ->middleware('guest')->name('password.email');

//Handle the actual password update
Route::post('/reset-password', [PasswordResetController::class, 'updatePassword'])
    ->middleware('guest')->name('password.update');

//Show the "Reset Password" form (from the email link)
Route::get('/reset-password/{token}', function (string $token) {
return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');


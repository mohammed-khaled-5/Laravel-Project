<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/listings', function () {
    return view('listings');
});

Route::get('/listing/{id}', function ($id) {
    return view('listing', ['id' => $id]);
});

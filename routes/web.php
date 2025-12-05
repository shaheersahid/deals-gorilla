<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/product-detail', function () {
    return view('product-detail');
});
Route::get('/product', function () {
    return view('product');
});

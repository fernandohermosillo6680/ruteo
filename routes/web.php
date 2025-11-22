<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::get('/productos', function () {
    return view('productos');
})->name('productos');

Route::get('/juegos', function () {
    return view('juegos');
})->name('juegos');

Route::get('/libros', function () {
    return view('libros');
})->name('libros');

Route::get('/nosotros', function () {
    return view('nosotros');
})->name('nosotros');

Route::view('/faq', 'faq')->name('faq');

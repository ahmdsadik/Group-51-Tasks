<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return <<< HTML
            <h1>Test</h1>
            HTML;
});

Route::get('/users', function () {
    return view('users.index');
});

Route::get('/users/edit', function () {
    return view('users.edit');
});

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

Route::get('/string_to_number',[\App\Http\Controllers\StringToNumber\StringToNumber::class, 'stringToNumber'])->name('string_to_number');

//Route::get('/string_to_number', function () {})

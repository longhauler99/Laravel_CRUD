<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;


Route::get('test/{id?}', [TestController::class, 'index'])->name('test');

Route::get('/', function () {
    return view('welcome');
});

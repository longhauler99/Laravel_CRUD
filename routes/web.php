<?php

use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Route;


Route::get('/display/employees', [CrudController::class, 'index'])->name('view');
Route::post('/add/employee', [CrudController::class, 'addEmployee'])->name('addEmployee');

Route::get('/', function () {
    return view('welcome');
});

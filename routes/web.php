<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/trainings', [App\Http\Controllers\TrainingController::class, 'index'])->name('training:index');
Route::get('trainings/create', [App\Http\Controllers\TrainingController::class, 'create'])->name('training:create');
Route::post('/trainings/create', [App\Http\Controllers\TrainingController::class, 'store'])->name('training:store');

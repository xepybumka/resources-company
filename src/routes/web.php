<?php

use App\Http\Controllers\ResourceController;
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


Route::controller(ResourceController::class)->group(function () {
    Route::get('/resource/', 'index')->name('resource.list');

    Route::get('/resource/create', 'create')->name('resource.create');
    // TODO: Добавить методы после создания БД и структуры
//    Route::post('/resource/create', 'store')->name('resource.store');

//    Route::get('/resource/{id}', 'show')->name('resource.show');
    Route::get('/resource/{id}/edit', 'edit')->name('resource.edit');
//    Route::put('/resource/{id}', 'update')->name('resource.update');
//    Route::patch('/resource/{id}', 'update')->name('resource.update');
//    Route::delete('/resource/{id}', 'destroy')->name('resource.destroy');
});



<?php

use App\Http\Controllers\URLController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeoLocationController;

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

//dashboard routes 
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard');

Route::post('/dashboard/add', [URLController::class, 'Dash_Add'])->name('dashboard.add');
//My link routes 
Route::get('/dashboard/links', [URLController::class, 'Dash_Link'])->name('dashboard.links');
Route::get('/dashboard/edit/{id}', [URLController::class, 'Dash_Edit'])->name('dashboard.edit');
Route::put('/dashboard/update/', [URLController::class, 'Dash_Update'])->name('dashboard.update');
Route::post('/dashboard/delete', [URLController::class, 'Dash_Delete'])->name('dashboard.delete');
Route::get('/dashboard/update', function () {
    abort(404,"page not found");
});
Route::get('/dashboard/delete', function () {
    abort(404,"page not found");
});
Route::get('/dashboard/add', function () {
    abort(404,"page not found");
});

//main page (visitor page ) routes

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::post('/visitor/add', [URLController::class, 'add'])->name('visitor.add');
Route::get('/visitor/add', function () {
    abort(404,"page not found");
});
Route::post('/password/check', [URLController::class, 'password_check'])->name('password.Check');
Route::get('/{id}', [URLController::class, 'get'])->name('get');
Route::get('password/{id}', [URLController::class, 'password'])->name('password');

 
Route::get('get-address-from-ip', [GeoLocationController::class, 'index']);




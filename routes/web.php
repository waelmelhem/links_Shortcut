<?php

use App\Http\Controllers\URLController;
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

//dashboard routes 
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard');


//user links routes --after login
//create the link with password and title 
//can edit the title and password and the real path of the created path 
//can take the Number of clicks on the link for a group of people for each country
Route::get('/dashboard/links', [URLController::class, 'Dash_Link'])->name('dashboard.links');
//create page 
Route::post('/dashboard/add', [URLController::class, 'Dash_Add'])->name('dashboard.add');
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
//only create link and share it
Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::post('/visitor/add', [URLController::class, 'add'])->name('visitor.add');
Route::get('/visitor/add', function () {
    abort(404,"page not found");
});
//The link may require a password to open
Route::post('/password/check', [URLController::class, 'password_check'])->name('password.Check');
Route::get('/{id}', [URLController::class, 'get'])->name('get');
Route::get('password/{id}', [URLController::class, 'password'])->name('password');





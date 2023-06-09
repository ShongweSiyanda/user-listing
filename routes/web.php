<?php

use App\Http\Controllers\UserListingController;
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

Route::controller(UserListingController::class)->group(function(){
    Route::get('/', 'index');
    Route::post('/', 'store')->name('users.store');
    Route::delete('/{id}', 'destroy')->name('users.destroy');
});

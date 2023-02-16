<?php

use App\Http\Controllers\UsersController;
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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::get('export/user', [UsersController::class, 'fast_excel_user'])->name('export_user');
Route::get('export/application', [UsersController::class, 'fast_excel_application'])->name('export_application');
Route::get('export/multiple', [UsersController::class, 'fast_excel_multiple'])->name('export_multiple');
Route::get('export/chunked', [UsersController::class, 'fast_excel_chunked'])->name('fast_excel_chunked');

<?php

use Illuminate\Support\Facades\Route;

include __DIR__.'/adminmart.php';
include __DIR__.'/user_admin.php';
include __DIR__.'/user_people.php';
include __DIR__.'/user_guru.php';
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


Route::redirect('/','/login/admin');

Route::view('login/santri','auth.login_santri');

Route::view('login/admin','auth.login_admin');

Route::post('/login/santri/proc', 'Auth\LoginController@santriLogin')->name('login-santri');
Route::post('/login/admin/proc', 'Auth\LoginController@adminLogin')->name('login-admin');
Route::any('santri/{id}/resetPassword','SantriController@resetPassword');
Route::any('guru/{id}/resetPassword','GuruController@resetPassword');


Route::view('login/','auth.login_santri');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

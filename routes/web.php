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
// Route::post('/send/invitaion','App\Http\Controllers\HomeController@sendInvitation')->name('sendInvitation');
 
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('register/request','App\Http\Controllers\Auth\RegisterController@requestInvitation')->name('requestInvitation');
Route::get('edit/profile','App\Http\Controllers\profileController@edit')->name('edit.profile');
Route::post('edit/profile/update','App\Http\Controllers\profileController@update')->name('update.profile');
Route::post('/invitations','App\Http\Controllers\invitationController@store')->name('storeInvitation');
Route::get('/{token}','App\Http\Controllers\invitationController@check')->name('token.check');
Route::post('/create/user','App\Http\Controllers\invitationController@createnewuser')->name('create.user');
Route::post('/activate','App\Http\Controllers\invitationController@active')->name('active.user');
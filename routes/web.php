<?php

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

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function(){
	Route::get('profile/edit/profile','ProfileController@edit')->name('profile.edit');
	Route::post('profile/account/update','ProfileController@accountUpdate')->name('account.update');
	Route::post('profile/update/profile','ProfileController@profileUpdate')->name('profile.update');
	//Last Route of this group
	Route::get('profile/{slug}','ProfileController@index')->name('profile.index');
});

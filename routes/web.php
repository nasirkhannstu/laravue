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
Route::get('/vuetest', function () {
    return \App\User::with('profile')->get();
});


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function(){
	Route::get('profile/edit/profile','ProfileController@edit')->name('profile.edit');
	Route::post('profile/account/update','ProfileController@accountUpdate')->name('account.update');
	Route::post('profile/update/profile','ProfileController@profileUpdate')->name('profile.update');
	
	Route::get('/check_relationship_status/{id}', 'FriendshipController@check')->name('check');
	Route::get('/add_friend/{id}', 'FriendshipController@add_friend')->name('add_friend');
	Route::get('/accept_friend/{id}', 'FriendshipController@accept_friend')->name('accept_friend');
	
	//Last Route of this group
	Route::get('profile/{slug}','ProfileController@index')->name('profile.index');
});

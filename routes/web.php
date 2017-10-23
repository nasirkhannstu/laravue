<?php



Route::get('/', function () {
	return view('auth.login');
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
	Route::get('/notifications', 'HomeController@notifications')->name('notifications');
	Route::post('/create/post', 'PostController@store')->name('create.post');


	Route::get('/feed', 'FeedController@feed')->name('feed');
	Route::get('/pagefeed/{id}', 'FeedController@pagefeed')->name('pagefeed');

	Route::get('/like/{id}', 'LikeController@like')->name('like');
	Route::get('/unlike/{id}', 'LikeController@unlike')->name('unlike');

	Route::post('/create/comment', 'CommentController@createComment')->name('createComment');
	
	Route::get('/search/blood_donars', 'DonarController@bloodDonars')->name('bloodDonars');
	Route::get('/blood', 'DonarController@blood')->name('search.blood');
	Route::get('/check_donation_status/{id}', 'DonarController@check')->name('donar.check');
	Route::get('/request/{id}', 'DonarController@request')->name('request');
	Route::get('/cancelrequest/{id}', 'DonarController@cancelrequest')->name('cancelrequest');
	Route::post('/new_doner', 'DonarController@newDoner')->name('newDoner');
	Route::get('/cancel_doner', 'DonarController@cancelDoner')->name('cancelDoner');
	Route::get('/user_all_donation_requests', 'DonarController@getAllDonars');
	Route::get('/accept_donation_request/{id}', 'DonarController@acceptDonars');
	Route::get('/check_auth_donation_status', 'DonarController@check_donation_status');
	Route::get('/get_accepted_donars', 'DonarController@get_accepted_donars');

	Route::get('/news-feed', 'FeedController@showFeed')->name('showFeed');

	//Create Store
	Route::get('/start-business', 'PageController@createBusiness')->name('createBusiness');
	Route::post('/start-business', 'PageController@createStore')->name('createStore');
	Route::get('/store/{slug}', ['as' => 'viewStore', 'uses' => 'PageController@viewStore'])->where('slug', '[\w\d\-\_]+');

// 	Route::get('/news-feed', function () {
// 	return view('feed.feed');
// });
	Route::get('/get_auth_user_data', function(){
		return Auth::user();
	});

	//Notifications
	Route::get('/get_unread', function(){
		return Auth::user()->unreadNotifications;
	});
	
	//Last Route of this group
	Route::get('profile/{slug}','ProfileController@index')->name('profile.index');
});

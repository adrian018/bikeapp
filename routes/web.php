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
use App\User;
Route::get('/', function () {
    return view('welcome');
});

/**
* Auth
**/
Auth::routes();

/**
* Tracks
**/

// View Tracks
Route::get( '/tracks', 'TrackController@index' ) -> name( 'tracks' ) -> middleware( 'auth' );

// Vizualizarea in detaliu a unei curse
Route::get( '/tracks/{id}', 'TrackController@viewTrack' ) -> name( 'viewtracks' ) -> middleware( 'auth' );

// Share pe timeline
Route::post( '/tracks', 'TrackController@shareTimeline' ) -> name( 'shareTrack' );

/**
* Profile
**/

// Edit profile
Route::get( '/profile/edit', 'ProfileController@editProfile' ) -> name( 'profile' ) -> middleware( 'auth' );

// Update Profile
Route::post( '/profile/edit', 'ProfileController@updateProfile' ) -> name( 'profile.update' ) -> middleware( 'auth' );

// Change Password
Route::get( '/profile/change-password', 'ProfileController@changePassword' ) -> name( 'changePassword' ) -> middleware( 'auth' );

// View Profile
Route::get( '/profile/{username}', 'ProfileController@getProfile' ) -> name( 'profile.index' );

/**
* Friends
**/

Route::get( '/friends', 'FriendController@index' ) -> name( 'friend.index' ) -> middleware( 'auth' );

Route::get( '/friends/add/{username}', 'FriendController@getAdd' ) -> name( 'friend.add' ) -> middleware( 'auth' );

Route::get( '/friends/accept/{username}', 'FriendController@getAccept' ) -> name( 'friend.accept' ) -> middleware( 'auth' );

/**
* Timeline
**/

// index
Route::get( '/timeline', 'TimelineController@index' ) -> name( 'timeline' );

// Add Comments
Route::post( '/timeline', 'CommentsController@store' ) -> middleware( 'auth' );

// Like/dislike Ajax
Route::post( '/timeline/ajax', 'TimelineController@likeDislike' );

/**
* Statuses
**/

Route::get( '/status', 'TimelineController@statusIndex' ) -> name( 'status' );

Route::post( '/timeline', 'TimelineController@postStatus' ) -> name( 'status.post' ) -> middleware( 'auth' );

Route::post( '/timeline/{status_id}/reply', 'TimelineController@postReply' ) -> name( 'status.reply' ) -> middleware( 'auth' );


/**
* Search
**/

Route::get( '/search', 'SearchController@getResults' ) -> name( 'search.results' );

Route::get( '/test', function() {
	$u2 = User::find(3);
	return $u = User::find(1) -> friends();
	return $u -> friendsOfMine();
} );

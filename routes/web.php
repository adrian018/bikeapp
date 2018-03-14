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

/**
* Auth
**/
Auth::routes();

/**
* Tracks
**/

// View Tracks
Route::get( '/tracks', 'TrackController@index' ) -> name( 'tracks' );

// Vizualizarea in detaliu a unei curse
Route::get( '/tracks/{id}', 'TrackController@viewTrack' ) -> name( 'viewtracks' );

// Share pe timeline
Route::post( '/tracks', 'TrackController@shareTimeline' ) -> name( 'shareTrack' );

/**
* Profile
**/

// edit profile
Route::get( '/profile/', 'ProfileController@editProfile' ) -> name( 'profile' );

//Update Profile
Route::post( '/profile', 'ProfileController@updateProfile' );

//Change Password
Route::get( '/profile/change-password', 'ProfileController@changePassword' ) -> name( 'changePassword' );

//Route::get( '/profile/edit', 'ProfileController@viewProfile' );


/**
* Timeline
**/
// index
Route::get( '/timeline', 'TimelineController@index' ) -> name( 'timeline' );

/**
* Profile
**/

// Add Comments
Route::post( '/timeline', 'CommentsController@store' );

// Like/dislike Ajax
Route::post( '/timeline/ajax', 'TimelineController@likeDislike' );
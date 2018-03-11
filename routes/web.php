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

// Auth
Auth::routes();

/**
* Tracks
**/

// View Tracks
Route::get( '/tracks', 'ProfileController@index' ) -> name( 'tracks' );

// Vizualizarea in detaliu a unei curse
Route::get( '/tracks/viewtrack/{id}', 'ProfileController@viewTrack' ) -> name( 'viewtracks' );

Route::post( '/tracks', 'ProfileController@shareTimeline' ) -> name( 'tracks' );

/**
* Profile
**/

// edit prpfile
Route::get( '/profile/', 'ProfileController@editProfile' ) -> name( 'profile' );

//Update Profile
Route::post( '/profile', 'ProfileController@updateProfile' );

//Change Password
Route::get( '/profile/change-password', 'ProfileController@changePassword' ) -> name( 'changePassword' );

//Route::get( '/profile/edit', 'ProfileController@viewProfile' );

Route::get( '/timeline', 'TimelineController@index' ) -> name( 'timeline' );

/**
* Profile
**/

// Add Comments
Route::post( '/timeline', 'CommentsController@store' );

// Like/dislike Ajax
Route::post( '/timeline/ajax', 'TimelineController@likeDislike' );
<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class FriendController extends Controller {
    public function index() {
    	$friends = Auth::user() -> friends();
    	$requests = Auth::user() -> friendRequests();
    	return view( 'friends', compact( 'friends', 'requests' ) );
    }

    public function getAdd( $username ) {
    	$user = User::where( 'username', $username ) -> first();
    	
    	//check if user exists
    	if( !$user ) {
    		return redirect() -> route( 'timeline' ) -> with( 'info', 'That user could not be found' );
    	}

    	// check if friend request is already submitted 
    	if( Auth::user() -> hasFriendRequestPending( $user ) || $user -> hasFriendRequestPending( Auth::user() ) ) {
    		return redirect() -> route( 'profile.index', [ 'username' => $user -> username ] ) 
    			-> with( 'info', 'Friend request already pending' );
    	}

    	//check if user is already friend 
    	if( Auth::user() -> isFriendsWith( $user ) ) {
    		return redirect() -> route( 'profile.index', [ 'username' => $user -> username ] ) 
    			-> with( 'info', 'You are already friends' );
    	}

    	Auth::user() -> addFriend( $user );
    	return redirect() -> route( 'profile.index', [ 'username' => $user -> username ] )
    		-> with( 'info', 'Friend request sent' );
    }

    public function getAccept( $username ) {
    	$user = User::where( 'username', $username ) -> first();

    	if( !$user ) {
    		return redirect() -> route( 'timeline' ) -> with( 'info', 'That user could not be found' );
    	}

    	if( !Auth::user() -> hasFriendRequestReceived( $user ) ) {
    		return redirect() -> route( 'timeline' ) -> with( 'info', 'Friend request already accepted' );
    	}

    	if( Auth::user() -> id == $user -> id ) {
    		return redirect() -> route( 'timeline' );
    	}
    	//accept friend request
    	Auth::user() -> acceptFriendsRequest( $user );

    	return redirect() -> route( 'profile.index', [ 'username' => $username ] );
    }

    public function friendDelete( $username ){
        $user = User::where( 'username', $username ) -> get();
        //$user = User::where('username', $username)->firstOrFail();
        dd( $user );
        if( !Auth::user() -> isFriendsWith( $user ) ){
           return redirect() -> back();
        }

        Auth::user() -> deleteFriend( $user );
        return redirect() -> back() -> with( 'info', 'Friend deleted' );
    }

}

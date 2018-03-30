<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Status;
use App\Comment;
use App\Timeline;
use App\Usermeta;
use Carbon\Carbon;
use Illuminate\Http\Request;


class TimelineController extends Controller {
	public function index() {
		$timelines = Timeline::with( 'user', 'track' ) -> paginate( 10 );

		return view( 'timeline.home', compact( 'timelines' ) );
	}	

	//temporary
	public function statusIndex() {
		
		$statuses = Status::notReply() -> where( function( $query ){
			return $query -> where( 'user_id', Auth::id() ) // my posts
				// or friends posts
				-> orWhereIn( 'user_id', Auth::user() -> friends() -> pluck( 'id' ) );
			} ) 
				-> orderBy( 'created_at', 'desc' )
				-> paginate( 10 );
		return view( 'status.home', compact( 'statuses' ) );
	}
	
	public function postReply( Request $request, $status_id ) {
		$this -> validate( $request, [
			"reply-{$status_id}"	=> 'required|max:1000',
		], [
			'required' => 'The reply body is required'
		]);

		$status = Status::notReply() -> find( $status_id );
		
		if( !$status ) {
			return redirect() -> route( 'status' ) -> with( 'info', 'Error' );
		}

		/*
			if you are NOT friends with the owner of the status
			AND you don't own the status

			without the 2nd condition you can't reply to your own statuses
		*/

		if( !Auth::user() -> isFriendsWith( $status -> user ) && Auth::id() !== $status -> user -> id ) {
			return redirect() -> route( 'status' );
		}
		
		$status -> replies() -> create([
			'body' => request("reply-{$status_id}"),
			'user_id' => Auth::id(),
		]);

		return redirect() -> back();
	}


	public function postStatus( Request $request ) {
		$this -> validate( $request, [
			'status'	=> 'required|max:1000',
		] );

		// referinta catre metoda statuses din Users prin hasMany
		Auth::user() -> statuses() -> create([
			'body'	=> $request -> status,
		]);

		return redirect() -> route( 'status' ) -> with( 'info', 'Status posted' );
	}

	public function getLike( $status_id ) {
		$status = Status::find( $status_id );
		if( !$status ) {
			return redirect() -> back();
		}

		if( !Auth::user() -> isFriendsWith( $status -> user ) ) {
			// momentan permit orice like
			//return redirect() -> back();
		}

		if( Auth::user() -> hasLikedStatus( $status ) ) {
			return redirect() -> back();
		}

		
		$like = $status -> likes() ->create([ 'user_id' => Auth::user() -> id ]);
		Auth::user() -> likes() -> save( $like );
		return redirect() -> back();
	}
}

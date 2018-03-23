<?php

namespace App;

use DB;
use Auth;
use App\User;
use App\Track;
use App\Comment;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model {

	private $user_id;
	protected $fillable = [ 'likes' ];
	
	static function test() {
		return $this -> belongsTo( 'App\Comment', 'timeline_id', 'id' );
	}

	public function comments() { // trebuie chemata ca o proprietate si nu ca o metoda
		// return $this -> hasMany( 'App\Comment', 'timeline_id', 'id' );
		return $this -> hasMany( Comment::class, 'timeline_id' );
	}

	public function user() {
		return $this -> belongsTo( 'App\User', 'user_id', 'id' );
	}

	public function track() {
		return $this -> belongsTo( 'App\Track', 'track_id', 'id' );
	}

	function usersComments( $userID ) { // TODO: gaseste un nume mai de doamne-ajuta
		$user = User::find( $userID );
		return $user;
		$this -> user_id = $user -> id;
		$this -> name = $user -> name;
		$this -> avatar = $user -> avatar;
	}

	public function avatarUrl( $user_id ) {
		if ( $this -> user -> avatar == 'default.jpg' ) {
            return url('public/avatars/default.jpg');
        }
        return url('public/avatars/' . $user_id . '/' . $this -> user -> avatar );
    }
	
	public function getInfoAttribute( $info ) {
		return unserialize( $info );
	}


	public function addComment( $comment ) {
		//dd($comment);
		Comment::create([
			'timeline_id'		=> $comment['timeline_id'],
			'comment'			=> $comment['comment'],
			'user_id'			=> $comment['user_id'],
		]);

	}

	public function post() {
		return $this -> belongsTo( User::class );
	}

	 public function getTimelineTracks() {
        // arg 1 = model
        // arg 2 = pivotul
        // arg 3 = cheia primara din model
        // arg 4 = cheia primara din pivot
        //return $this -> belongsToMany( 'App\User', 'timelines', 'id', 'user_id' ) -> withPivot( 'track_id' );
        return $queue = DB::table('timelines')
           -> join(
                'users',
                'users.id','=','timelines.user_id'
            )
            -> join(
                'tracks',
                'tracks.id','=','timelines.track_id'
            )
            -> select( 'timelines.*', 'tracks.*' )
            -> paginate(10);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Comment;
use Auth;

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

	public function user( $userId ) {
		return $user = User::find( $userId );
	}

	public function usersComments( $userID ) { // TODO: gaseste un nume mai de doamne-ajuta
		$user = User::find( $userID );
		return $user;
		$this -> user_id = $user -> id;
		$this -> name = $user -> name;
		$this -> avatar = $user -> avatar;
	}

	public function avatarUrl( $user_id ) {
		if ( $this -> user( $user_id ) -> avatar == 'default.jpg' ) {
            return url('public/avatars/default.jpg');
        }
        return url('public/avatars/' . $user_id . '/' . $this -> user( $user_id ) -> avatar );
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

}

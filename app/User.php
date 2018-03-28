<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'first_name', 'last_name', 'location', 'password', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
    */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
    *  Names and usernames
    */

    public function getName() {
        if( $this -> first_name && $this -> last_name ) {
            return "{$this -> first_name} {$this -> last_name}";
        }
        
        if( $this -> first_name ) {
            return $this -> first_name;
        }
        return null;
    }

    public function getNameOrUsername() {
        return $this -> getName() ? : $this ->username;
    }

    public function getFirstNameOrUsername(){
        return $this -> first_name ? : $this ->username;
    }

    public function avatarUrl() {
        if ( $this -> avatar == 'default.jpg' ) {
            return url('public/avatars/default.jpg');
        }
        return url('public/avatars/' . $this -> id . '/' . $this -> avatar );
    }

    /*
    * Friends Stuff
    */

    // https://laravel.com/docs/5.6/eloquent-relationships#many-to-many
    public function friendsOfMine() {
        return $this->belongsToMany( 'App\User', 'friends', 'user_id', 'friend_id' );
    }

    public function friendOf() {
        return $this->belongsToMany( 'App\User', 'friends', 'friend_id', 'user_id' );
    }

    public function friends() {
        return $this->friendsOfMine()->wherePivot('accepted', true) -> get()
                ->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }

    public function friendRequests() {
        return $this -> friendsOfMine() -> wherePivot( 'accepted', false ) -> get();
    }

    public function friendRequestsPending() {
        return $this -> friendOf() -> wherePivot( 'accepted', false ) -> get();
    }
    // check if user has friend request pending
    public function hasFriendRequestPending( User $user ) {
        return (bool) $this -> friendRequestsPending() -> where( 'id',  $user -> id) -> count();
    }

    public function hasFriendRequestReceived( User $user ) {
        return (bool) $this -> friendRequests() -> where( 'id', $user -> id ) -> count();
    }

    public function addFriend( User $user ) {
        $this -> friendOf() -> attach( $user -> id );
        // attach introduce in bd
        // sync verifica inainte
    }

    public function acceptFriendsRequest( User $user ) {
        $this   -> friendRequests() 
                -> where( 'id', $user -> id ) 
                -> first() 
                -> pivot 
                -> update( [
                    'accepted' => true,
            ] );
    }

    public function isFriendsWith( User $user ) {
        return (bool)$this -> friends() -> where( 'id', $user -> id ) -> count();
    }

    /*
    * Timeline Stuff
    */

    public function getTimelineTracks() {
        // arg 1 = model
        // arg 2 = pivotul
        // arg 3 = cheia primara din model
        // arg 4 = cheia primara din pivot
        return $this -> belongsToMany( 'App\User', 'timelines', 'id', 'user_id' ) -> withPivot( 'track_id' );
    }

    public function statuses() {
        return $this -> hasMany( 'App\Status', 'user_id' );
    }

}

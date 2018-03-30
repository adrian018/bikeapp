<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model {
    
    protected $table = 'likeable';
     protected $fillable = [
        'user_id', 'likeable_id', 'likeable_type',
    ];

    /*
    *declare model as a polymorph and get all the owning likeable models
	*/
	public function likeable() {
    	return $this -> morphTo();
    }

 	/*
 	* returns like-user relationship
 	*/
    public function user() {
    	return $this -> belongsTo( 'App\User', 'user_id' );
    }
}

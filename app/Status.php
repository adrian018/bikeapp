<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model{
    protected $table = 'statuses';
    protected $fillable = [
    	'user_id',
    	'parent_id',
    	'body'
    ];

    public function user() {
    	return $this -> belongsTo( 'App\User', 'user_id' );
    }
    // query scope in order to return parent statuses
    public function scopeNotReply( $query ){
    	return $query -> whereNull( 'parent_id' );
    }
    
    public function replies() {
    	return $this -> hasMany( 'App\Status', 'parent_id' );
    }

    /**
     * Polymorph class
     * @return [relationship]
     * @param model's name
     * @param method's name
     */

    public function likes() {
        return $this -> morphMany( 'App\Like', 'likeable' );
    }

    
}

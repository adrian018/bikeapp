<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use Illuminate\Http\Request;
use App\Timeline;

class Comment extends Model {
	
	protected $fillable = ['comment', 'timeline_id', 'user_id'];

	public function timeline() { // trebuie sa aiba numele parintelui ca sa faca corelatia
		return $this -> hasMany( Timeline::class );
	}

	
}

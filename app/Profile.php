<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

	static function getCorrectPolylineAttribute( $track ) {
		return str_replace( "\\", "\\\\", $track);
	}

	
}

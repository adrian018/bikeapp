<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model {
    
    public function tracks() {
    	 return $this -> hasMany( 'App\Track', 'user_id' );
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model {
    
    public function tracks() {
    	 return $this -> hasMany( 'App\Track', 'user_id' );
    }
    
    // Solve the \ escape string
    public function getTrackAttribute( $track ) {
    	return $track;
    	//return str_replace( "\\", "\\\\", $track);
    } 
  
    // unserialize meta from db
    public function getMetaAttribute ( $meta ) {
    	return unserialize( $meta );
    } 

    public function getSmallTracksAttribute ( $meta ) {
    	return unserialize( $meta );
    }

}

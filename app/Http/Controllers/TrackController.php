<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Input as Input;
use Auth;
use App\Profile;
use App\Timeline;
use App\Track;

class TrackController extends Controller {
   
    public function index(){
        $users = Auth::user(); // get the user
        $tracks = Track::find( $users -> id )->tracks;
       
        return view('profile.home', compact( 'users', 'tracks' ) );
    }

    public function viewTrack( $id ) {
        // creaza o noua instanta a modelului autentificarii
        $users = Auth::user();
        // parseaza json-ul
        $tracks = json_decode( file_get_contents( 'http://dev.risksoft.ro/bike/bikes/' . $users -> email . '.php' ), true );

        // returneaza cursa al carui id e egal cu cel din url
        foreach( $tracks['data'] as $track ) {

            if( $track[ 'id' ] == $id ) {
                // transformam din vector in obiect
                $track = (object)$track;
                // rezolva problema escape-ului cauzat de '\' 
                $track -> track = Profile::getCorrectPolylineAttribute( $track -> track );

                // verifica daca sunt si trasee coomplexe
                if( property_exists ( $track, 'smalltracks' ) ) {
                    if( count( $track -> smalltracks ) > 0  ) {
                        // rezolva problema escape-ului cauzat de '\' 
                        for( $i = 0; $i < count( $track -> smalltracks ); $i++ ) {
                            $track -> smalltracks[ $i ] = Profile::getCorrectPolylineAttribute(  $track -> smalltracks[ $i ] );
                        }
                    }
                } 

                return view( 'profile.viewtrack', compact( 'track' ) );
            }

        }
    }

  
}

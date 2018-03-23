<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Track;
use App\Profile;
use App\Timeline;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Input as Input;

class TrackController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(){
        $users = Auth::user(); // get the user
        $tracks = Track::find( Auth::user() -> id )-> tracks;
        return view('profile.home', compact( 'users', 'tracks' ) );
    }

    
    public function viewTrack( $id ) {
        // creaza o noua instanta a modelului autentificarii
        $user = Auth::user();
        // parseaza json-ul
        $track = Track::find( $id );

        if( $user -> id != $track -> user_id ) {
            return redirect() -> route( 'timeline' );
        }
        // return $track;
        return view( 'profile.viewtrack', compact( 'track' ) );
    }

    public function shareTimeline( Request $request ) {

        $timeline = new Timeline();
        $timeline -> user_id = $request -> user_id;
        $timeline -> track_id = $request -> track_id;
               
        if ( Timeline::where( 'track_id', '=', $request -> track_id ) -> count() > 0 ) {
            return redirect( '/tracks/' . $timeline -> track_id )
            -> with( 'status', array(  'warning' , 'Cursa a fost distribuita deja' ) ); 
        } else {
            $save = $timeline -> save();

            if ( $save ) {
                return redirect( '/tracks/' . $timeline -> track_id )
                -> with( 'status', array( 'success', 'Cursa a fost distribuita cu succes' ) );
            } else {
                return redirect( '/tracks/' . $timeline -> track_id )
                -> with( 'status', array(  'danger' , 'A aparut o eroare :( mai trage un loz' ) ); 
            }
        }
    }
}

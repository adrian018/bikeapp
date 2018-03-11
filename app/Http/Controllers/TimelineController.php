<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timeline;
use Carbon\Carbon;
use App\Comment;
use App\Usermeta;
use Auth;


class TimelineController extends Controller {
	public function index() {
		
		$timelines = Timeline::paginate(10);
		
		return view( 'timeline.home', compact( 'timelines' ) );
	}
	
	/**
	 * likeDislike Handles the ajax request for the like/dislike button
	 * @param  Request $request: The ajax request via post method
	 * @return [type: json]           [description: returns the status of the call - debug purposes]
	 */
	public function likeDislike( Request $request ) {
		if ( $request->isMethod('post') ){    
			
			$timeline = Timeline::findOrFail( $request -> timeline_id );
			$likes = unserialize( $timeline -> likes );
			
			$l = array(
				'likes' => $request -> user_id ,
				'dislike' => $request -> user_id ,
			);

			if( $request -> thumb_type == 'like' ) {
				if ( !in_array( $l[ 'likes' ], $likes[ 'likes' ] ) ) {
					$likes[ 'likes' ][] =  (int)$l[ 'likes' ];
					try {
						$timeline -> update( array( 'likes' => serialize( $likes ) ) );
						return response()->json(['response' => 'Like cu succes']);
					} catch (\Exception $e) {
						return response()->json([ 'response' => $e ]);
					}
				} else {
					return response()->json(['response' => 'Like dat deja']);
				}
			} else {
				if ( !in_array( $l[ 'dislike' ], $likes[ 'dislikes' ] ) ) {
					$likes[ 'dislikes' ][] =  (int)$l[ 'dislike' ];
					return response()->json(['response' => 'Dislike cu succes']);
					try {
						$timeline -> update( array( 'likes' => serialize( $likes ) ) );
					} catch (\Exception $e) {
						return $e;
					}
				} else {
					return response()->json(['response' => 'Dislike dat deja']);
				}
			}


		} else {
			return response()->json(['response' => 'API Error']);
		}

	}

	public function shareTimeline( Request $request ) {
       
        $timeline = new Timeline();
        $timeline -> user_id = $request -> user_id;
        $timeline -> track_id = $request -> track_id;
        $timeline -> info = serialize( $request -> info );
        $timeline -> track =  $request -> track;
        
       if ( Timeline::where( 'track_id', '=', $request -> track_id ) -> count() > 0 ) {
            return redirect( '/tracks/viewtrack/' . $timeline -> track_id )
                        -> with( 'status', array(  'warning' , 'Cursa a fost distribuita deja' ) ); 
        } else {
            $save = $timeline -> save();
                  
            if ( $save ) {
                return redirect( '/tracks/viewtrack/' . $timeline -> track_id )
                        -> with( 'status', array( 'success', 'Cursa a fost distribuita cu succes' ) );
            } else {
                return redirect( '/tracks/viewtrack/' . $timeline -> track_id )
                        -> with( 'status', array(  'danger' , 'A aparut o eroare :( mai trage un loz' ) ); 
            }
        }
    }
}

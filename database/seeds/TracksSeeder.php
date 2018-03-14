<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TracksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tracks = json_decode( file_get_contents( 'http://ivelo.conceptapps.ro/api/v2/bike2work/andrei.ionescu@stefanini.com' ), true );

            foreach( $tracks['data'] as $track ) {

                
                    $track = (object)$track;
                    // rezolva problema escape-ului cauzat de '\' 
                    //$track -> track = str_replace( "\\", "\\\\", $track -> track);
                    $meta = array();
                    array_push($meta,  $track -> description);
                    array_push($meta,  $track -> distance);
                    array_push($meta,  $track -> duration);
                    array_push($meta,  $track -> avg_speed);
                    array_push($meta,  $track -> max_speed);
                    $meta = serialize( $meta );
                    
                    // verifica daca sunt si trasee coomplexe
                    if( isset( $track -> smalltracks ) ) {

                        if( count( $track -> smalltracks ) > 0  ) {
                            $smalltrack = array();
                           //vazut daca asta rezolva problema
                            $smalltrack = $track -> smalltracks ;
                            $smalltrack = serialize( $smalltrack );

                        } else {
                            $smalltrack = NULL;
                        }

                    } else {
                        $smalltrack = NULL;
                    }

  
                


        DB::table('tracks')->insert([
            'user_id'       => 3,
            'track'         => $track -> track_simplified,
            'meta'          => $meta,
            'small_tracks'  => $smalltrack,
            'start_date'    => $track -> start_time,
            'end_date'      => $track -> start_time,
            
        ]);


        } 
     
    }
}

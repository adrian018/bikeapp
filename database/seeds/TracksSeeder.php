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
        $tracks = json_decode( file_get_contents( 'http://dev.risksoft.ro/bike/bikes/test@test.com.php' ), true );

            foreach( $tracks['data'] as $track ) {

                
                    $track = (object)$track;
                    // rezolva problema escape-ului cauzat de '\' 
                    $track -> track = str_replace( "\\", "\\\\", $track -> track);

                    // verifica daca sunt si trasee coomplexe
                    if( count( $track -> smalltracks ) > 0 ) {
                        $smalltrack = array();
                        // rezolva problema escape-ului cauzat de '\' 
                       // for( $i = 0; $i < count( $track -> smalltracks ); $i++ ) {
                            //$track -> smalltracks[ $i ] = str_replace( "\\", "\\\\", $track -> smalltracks[ $i ] );
                            
                       // }
                        array_push($smalltrack,  $track -> smalltracks);
                        $smalltrack = serialize( $smalltrack );

                    } else {
                        $smalltrack = NULL;
                    }
  
                


            DB::table('tracks')->insert([
            'user_id'       => 1,
            'track'         => $track -> track,
            'meta'          => $track -> start_time,
            'small_tracks'  => $smalltrack,
            'start_date'    => $track -> start_time,
            'end_date'      => $track -> start_time,
            
         ]);


        } 
     
    }
}

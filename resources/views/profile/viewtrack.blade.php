@extends('layouts.app')

@section( 'custom-scripts' )

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDdLSrA9nIpqdBf2vPdkWFJL2Yi7diMCgI&libraries=geometry&sensor=true&ver=1.9"></script>
<script type="text/javascript" src="{{ URL::asset('public/js/profile/gmaps.js') }}"></script>

@endsection

@section('content')


<script>
    polylines = [];
    jQuery( document ).ready( function( $ ) {
      // Creaza o noua instanta de Google Maps
      map = new GMaps({
        div: '#track-map',
        lat: 44.435506,
        lng: 26.102523,
        zoom: 11
    });


     // Deseneaza o polilinie pe harta
     function addtracks( pl, culoare, zoom ) {
        var decodedPath = google.maps.geometry.encoding.decodePath( pl );
        var polyline = map.drawPolyline({
            path: decodedPath,
            strokeColor: culoare,
            strokeOpacity: 0.6,
            strokeWeight: 6
        });

        polylines.push( polyline );
        if ( zoom ) {
            zoomToObject( decodedPath );
        }
    }



    // Zoom catre o polilinie
    function zoomToObject( obj ) {
    // returneaza limetele hartii - momentan -180 180 long, -90 90 lat
    var bounds = new google.maps.LatLngBounds();
    // loop prin variabila obj. aceasta primeste ca valoare polilinia decodata
    for ( var n = 0; n < obj.length; n++ ) {
        // extinde obiectul bounds cu coordonatele vertexilor poliliniei
        bounds.extend( obj[ n ] );
    }
    // creaza limita pe baza noilor coordonate
    map.fitBounds(bounds);
}




$( '#detalii a' ).click(function() {

    let type = ( $(this).attr( 'class' ) );

            // delet all polylines from map
            deleteOverlays();
            // toggle active class
            $('#detalii tr').removeClass('active');

            $(this).parent().parent().addClass('active');
            
            switch ( type ) {
                case 'show_start_track': 
                addtracks( $(this).data('polyline'), '#3dff00', 0 );
                break;

                case 'show_stop_track':
                addtracks( $(this).data('polyline'), '#aaa', 0 ); 
                break;

                case 'show_full_track':
                addtracks("{!! $track -> track !!}");
                break;
            }

            $("html, body").animate({ scrollTop: 0 }, "slow");

        })

// sterge poliliniile de pe harta
function deleteOverlays() {
    if ( polylines ) {
        for ( i in polylines ) {
            polylines[i].setMap( null );
        }
        polylines.length = 0;
    }
}


function addtracks( pl, culoare, zoom ) {
    var decodedPath = google.maps.geometry.encoding.decodePath( pl );
    var polyline = map.drawPolyline({
        path: decodedPath,
        strokeColor: culoare,
        strokeOpacity: 0.6,
        strokeWeight: 6
    });
    polylines.push(polyline);
    if (zoom) {
        zoomToObject(decodedPath);
    }
}

@if ( $track[ 'small_tracks' ] )
    @foreach ( $track[ 'small_tracks' ] as $small_track )
        @if( $small_track[ 'type' ] == 1 )
            addtracks( '{{ str_replace( "\\", "\\\\", $small_track[ "track" ] ) }}', '#3dff00', 0 );
        @else 
            addtracks( '{{ str_replace( "\\", "\\\\", $small_track[ "track" ] ) }}', '#000', 0 );
        @endif
    @endforeach
    @else
    addtracks( '{{ str_replace( "\\", "\\\\", $track ->  track ) }}', '#3dff00', false  );
@endif
});
</script>

   
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><p>Vizualizare cursa {{ $track -> id }} - {{ $track -> meta[ 0 ] }}</p>
                    @if (session('status'))
                    @php
                        $status = session( 'status' )
                    @endphp
                    <div class="alert alert-{{ $status[0] }}">
                      {{ $status[1] }}
                    </div>
                    @endif
                    <div class="btn-group">
                        <form action="{{ route( 'shareTrack') }}" method="POST" class="pull-left">
                            <input name="user_id" type="hidden" value="{{ Auth::id() }}">
                            {{ csrf_field() }}
                            <input name="info[]" type="hidden" value="{{ $track -> meta[ 0 ] }}">
                            <input name="track_id" type="hidden" value="{{ $track -> id }}">
                            <input name="info[]" type="hidden" value="{{ $track -> meta[ 3 ] }}">
                            <input name="info[]" type="hidden" value="{{ $track -> meta[ 4 ] }}">
                            <input name="info[]" type="hidden" value="{{ $track -> meta[ 2 ] }}">
                            <input name="info[]" type="hidden" value="{{ $track -> meta[ 1 ] }}">
                            <input name="track" type="hidden" value="{{ $track -> track }}">
                            <input type="submit" class="btn btn-success" value="Share">
                        </form>
                        <a href="{{ route( 'tracks' ) }}" class="btn btn-primary pull-left">Inapoi la curse</a>
                    </div>
                </div>
                
                <div class="panel-body">

                  <div id="track-map" style="width: 100%; height:350px;"></div>

                  <table id="detalii" class="table">
                    <!-- verifica daca exista curse multiple -->
                    @if( $track -> small_tracks != NULL )
                    <thead>
                        <tr>
                            <th>Tip cursa</th>
                            <th>Data Inceput</th>
                            <th>Data Sfarsit </th>
                            <th>Durata (min)</th>
                            <th>Viteza Maxima (km/h)</th>
                            <th>Viteza Medie (km/h)</th>
                            <th>Distanta parcursa (km)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="javascript:void(0)" class="show_full_track">Principala</a></td>
                            <td>{{ $track -> start_date }}</td>
                            <td>{{ $track -> end_date }}</td>
                            <td>{{ $track -> meta[ 2 ] }}</td>
                            <td>{{ $track -> meta[ 4 ]}}</td>
                            <td>{{ $track -> meta[ 3 ] }}</td>
                            <td>{{ $track -> meta[ 1 ] }}</td>
                        </tr>
                        <!-- parcurge cursele multiple  -->
                        <tr>
                            @foreach ( $track[ 'small_tracks' ] as $small_track )
                                @if( $small_track[ 'type' ] == 1 )
                                   <td>
                                        <a href="javascript:void(0)" class="show_start_track" data-polyline="{{ $small_track[ 'track' ] }}">Start</a>
                                    </td>
                                @else 
                                    <td>
                                        <a href="javascript:void(0)" class="show_stop_track" data-polyline="{{ $small_track[ 'track' ] }}">Stop</a>
                                    </td>
                                @endif
                                <td>{{ $small_track [ 'start_time' ] }}</td>
                                <td>{{ $small_track [ 'start_time' ] }}</td>
                                <td>{{ $small_track [ 'duration' ] }}</td>
                                <td>{{ $small_track [ 'max_speed' ] }}</td>
                                <td>{{ $small_track [ 'avg_speed' ] }}</td>
                                <td>{{ $small_track [ 'distance' ] }}</td>
                        </tr>
                            @endforeach
                       
                    </tbody>
                    @else
                    <!-- cursa normala  -->
                    <thead>
                        <tr>
                            <th>Data Inceput</th>
                            <th>Data Sfarsit </th>
                            <th>Durata (min)</th>
                            <th>Viteza Maxima (km/h)</th>
                            <th>Viteza Medie (km/h)</th>
                            <th>Distanta parcursa (km)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $track -> start_date }}</td>
                            <td>{{ $track -> end_date }}</td>
                            <td>{{ $track -> meta[ 2 ] }}</td>
                            <td>{{ $track -> meta[ 4 ] }}</td>
                            <td>{{ $track -> meta[ 3 ] }}</td>
                            <td>{{ $track -> meta[ 1 ] }}</td>
                        </tr>    
                    </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<div class="container">
   <div class="row">
    <div class="col-md-10 col-md-offset-2">

    </div>
</div>
</div>

@endsection

@section( 'footer' )

@endsection
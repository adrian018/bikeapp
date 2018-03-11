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

// verifica daca exista curse multiple
@if ( property_exists ( $track, 'smalltracks' )  )
    @if( count( $track -> smalltracks ) > 0  )
        // daca da, parcurge-le
        @foreach( $track -> smalltracks as $smalltracks )    
            // cursa valida
            @if ( $smalltracks[ 'type' ] == 1 )
                // deseneaza cursa pe harta cu verde
                addtracks( "{{ $smalltracks[ 'track' ] }}", '#3dff00', 0 );
                @else
                //cursa invalida
                //deseneaza cursa cu negru
                addtracks( "{{ $smalltracks[ 'track' ] }}", '#aaa', 0 ); 
                @endif
                @endforeach
                @else 
       
    @endif
// daca nu exista, atunci deseneaza cursa principala
@else  
    addtracks("{!! $track -> track !!}")
@endif

});
</script>


<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Vizualizare cursa {{ $track -> id }} - {{ $track -> title }}  
                    @if (session('status'))
                    @php
                        $status = session( 'status' )
                    @endphp
                    <div class="alert alert-{{ $status[0] }}">
                      {{ $status[1] }}
                    </div>
                    @endif
                    <form action="{{ route( 'shareTrack') }}" method="POST">
                        <input name="user_id" type="hidden" value="{{ Auth::id() }}">
                        {{ csrf_field() }}
                        <input name="info[]" type="hidden" value="{{ $track -> title }}">
                        <input name="track_id" type="hidden" value="{{ $track -> id }}">
                        <input name="info[]" type="hidden" value="{{ $track -> avg_speed }}">
                        <input name="info[]" type="hidden" value="{{ $track -> max_speed }}">
                        <input name="info[]" type="hidden" value="{{ $track -> duration }}">
                        <input name="info[]" type="hidden" value="{{ $track -> distance }}">
                        <input name="track" type="hidden" value="{{ $track -> track_simplified }}">
                        <input type="submit" class="btn btn-success" value="Share">
                    </form>
                </div>
                
                <div class="panel-body">

                  <div id="track-map" style="width: 100%; height:350px;"></div>

                  <table id="detalii" class="table">
                    <!-- verifica daca exista curse multiple -->
                   @if ( property_exists ( $track, 'smalltracks' ) && count( $track -> smalltracks ) > 0 )
                 
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
                            <td>{{ $track -> start_time }}</td>
                            <td>{{ $track -> end_time }}</td>
                            <td>{{ $track -> duration }}</td>
                            <td>{{ $track -> max_speed }}</td>
                            <td>{{ $track -> avg_speed }}</td>
                            <td>{{ $track -> distance }}</td>
                        </tr>
                        <!-- parcurge cursele multiple  -->
                        @foreach( $track -> smalltracks as $smalltracks )

                        <tr>
                            <td>
                                @if ( $smalltracks[ 'type' ] == 1 )
                                <!-- cursa valida -->
                                <a href="javascript:void(0)" class="show_start_track" data-polyline="{{ $smalltracks[ 'track' ] }}">Start</a>
                                @else
                                <!-- cursa invalida  -->
                                <a href="javascript:void(0)" class="show_stop_track" data-polyline="{{ $smalltracks[ 'track' ] }}">Stop</a>
                                @endif
                            </td>
                            <td>{{ $smalltracks[ 'start_time' ] }}</td>
                            <td>{{ $smalltracks[ 'end_time' ] }}</td>
                            <td>{{ $smalltracks[ 'duration' ] }}</td>
                            <td>{{ $smalltracks[ 'max_speed' ] }}</td>
                            <td>{{ round( $smalltracks[ 'avg_speed' ], 2 ) }}</td>
                            <td>{{ $smalltracks[ 'distance' ] }}</td>
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
                            <td>{{ $track -> start_time }}</td>
                            <td>{{ $track -> end_time }}</td>
                            <td>{{ $track -> duration }}</td>
                            <td>{{ $track -> max_speed }}</td>
                            <td>{{ $track -> avg_speed }}</td>
                            <td>{{ $track -> distance }}</td>
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
@extends('layouts.app')

@section( 'custom-scripts' )

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDdLSrA9nIpqdBf2vPdkWFJL2Yi7diMCgI&libraries=geometry&sensor=true&ver=1.9"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.25/gmaps.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Your tracks</div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    Welcome, <a href="/profile/{{ $users -> id }}">{{ $users -> name }}</a>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    polylines = [];
    user = "{{ $users -> email }}";

    jQuery(document).ready( function( $ ) {

    // Creaza o noua instanta de Google Maps
    map = new GMaps({
        div: '#track-map',
        lat: 44.435506,
        lng: 26.102523,
        zoom: 11
    });

    getAllData( user );
    
    function getAllData( user ) {
    if ( user ) { // Verificare daca user-ul e logat

        // declararea variabilelor pentru statistici
        nr_curse = 0;
        durata_totala = 0;
        km_parcursi = 0;
        viteza_medie = 0;

        var table = jQuery('#track-list tbody'); // scurtatura pentru selectorul tabelului
        var path = "{{-- route( 'tracksAPI' ) --}}"; // crearea url-ului pentru JSON
        
        var rows = '';

    
       

    } else { // user-ul nu e logat
        rows = '<td colspan="5" class="info">Va rugam sa va logati</td>';
        jQuery(table).empty();
        jQuery(rows).appendTo(table);
    }

}

    // Afisare unei polilinii la click
    jQuery( document ).on( 'click', 'a.show-track, a.show-multiple-tracks', function( event ) {
        // opreste comportamentul implicit al ancorei
        event.preventDefault();
        // Sterge poliliniile existente
        deleteOverlays();
        // inlatura clasa active de pe randul tabelului
        jQuery( '#track-list tr' ).removeClass( 'active' );
        // adauga clasa active elementului care a fist selectat
        jQuery( this ).parent().parent().addClass( 'active' );
        // variabila in care va fi stocata numele clasei
        let type = jQuery( this ).attr( 'class' );

        if ( type == 'show-track' ) { // a fost selectat o cursa simpla
            // deseneaza o polilinie cu informatiile din data-polyline  
            addtracks( jQuery( this ).data( 'polyline' ), '#3dff00', true );
        } else { // a fost selectata o cursa multipla
            // informatia din data-polyline  
            let polyline_pre_array = jQuery(this).data('polylines');
            // creat un vector impartind informatia din data-polyline dupa delimitatorul -sfarsit- 
            let polyline_array = polyline_pre_array.split('-sfarsit-');
            // loop prin vector
            for ( var i = 0; i < polyline_array.length - 1; i++ ) {
                if ( ( polyline_array[ i ].substr( polyline_array[ i ].length - 3, 3 ) ) == 'dap' ) { // detectat daca e inceput de cursa
                    addtracks( polyline_array[ i ].substr( 0, polyline_array[ i ].length - 3 ), '#3dff00', 0 ); // deseneaza o polilinie de culoare verde
                } else { // sfarsit de cursa
                    addtracks( polyline_array[i].substr( 0, polyline_array[i].length - 3), '#000', 0 ); // deseneaza o polilinie de culoare neagra
                }

            }
        }

        jQuery("html, body").animate({ scrollTop: 0 }, "slow");

    });



});

jQuery( document ).ready( function() {
    @foreach( $tracks as $track )
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
    @endforeach  
})

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


// sterge poliliniile de pe harta
function deleteOverlays() {
    if ( polylines ) {
        for ( i in polylines ) {
            polylines[i].setMap( null );
        }
        polylines.length = 0;
    }
}

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
</script>
 

<div class="container" id="tracks">
    <div class="row">
        <div class="col-md-12">
            <div id="track-map" style="width: 100%; height:350px;"></div>
            <table id="track-list" class="table table-striped">
                <thead>
                    <th>Nume Cursa</th>
                    <th>Data Inceput</th>
                    <th>Data Sfarsit</th>
                    <th>Durata</th>
                    <th>Vezi detalii</th>
                </thead>
                <tbody>
                    @foreach( $tracks as $track )
                      <tr><td><a href="#" class="show-track" data-polyline='{{ $track ->  track }}'>{{ $track -> meta[0] == '' ? "Cursa " . $track -> id : $track -> meta[0] }}</a></td><td>{{ $track -> start_date }}</td><td>{{ $track -> end_date }}</td><td>{{ $track -> meta[2] }} minute </td><td><a href="{{ route( 'tracks' ) }}/{{ $track -> id }}">Vezi detalii</a></td></tr>
                    @endforeach
                </tbody>
                <tfoot>
                </tfoot>
            </table>   
        </div>
    </div>
</div>

@endsection

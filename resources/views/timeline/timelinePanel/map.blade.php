  <script type="text/javascript">
  	$( document ).ready( function() {
  		let map = map_{{ $timeline -> id }}
  		map = new GMaps( {
  			div: '#map_{{ $timeline -> id }}',
  			lat: 44.435506,
  			lng: 26.102523,
  			zoom: 11
  		})

  		var decodedPath = google.maps.geometry.encoding.decodePath( "{{ $timeline -> track }}" );
  		var polyline = map.drawPolyline({
  			path: decodedPath,
  			strokeColor: '#000',
  			strokeOpacity: 0.6,
  			strokeWeight: 6
  		});
  	} )
  </script>

  <div id="map_{{ $timeline -> id }}" style="width: 100%; height: 300px;"></div>
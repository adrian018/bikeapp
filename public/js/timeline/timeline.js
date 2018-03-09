$( document ).ready( function() {

	$( '.thumbs .fa' ).click( function() {
		let element = $( this );
		let track_id = $( this ).parent().parent().attr( 'data-track' );
		let type_name = $( this ).attr( 'data-thumb' );
		let users_id = $( this ).parent().parent().attr( 'data-user' );

		if ( element.hasClass( 'pressed' ) ) {
			return;
		}

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
		$.ajax({
			type: 'post',
			url: '/timeline/ajax', 
			dataType: 'json',
			data: { 	
				timeline_id: track_id,
				thumb_type: type_name,
				user_id: users_id,
			},

			success: function( data, status ){ 
				console.log(data.response);
				if ( type_name == 'like' ) {
					element.next().text( parseInt( element.next().text() ) + 1);
					element.addClass( 'liked pressed' );
				} else {
					element.next().text( parseInt( element.next().text() ) + 1);
					element.addClass( 'disliked pressed' );
				}
				
			},
			error: 	function (xhr, ajaxOptions, thrownError) {
				console.log(xhr.status);
				console.log(thrownError);
			}	
		});

	} )
} )
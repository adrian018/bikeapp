@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-6">
			<h3>Your friends</h3>
			@forelse( $friends as $user )
				@include('blocks.userblock' )
			@empty
				<p>You have no friends.</p>
			@endforelse
		</div>
		
		<div class="col-lg-6">
			<h4>Friend requests</h4>
				
			@forelse($requests as $user)
				@include('blocks.userblock')
			@empty
				<p>You have no friend requests.</p>
			@endforelse
		</div>
	</div>
</div>
@stop

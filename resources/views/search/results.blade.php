@extends('layouts.app')

@section('content')
<div class="container">
	<h3>Your search for "{{  Request::input( 's' ) }}"</h3>
	@if( !$users -> count() )
		<p>No results</p>
	@else
		<div class="row"
			<div class="col-lg-12">
				@forelse($users as $user)
					@include('search.userblock')
				@empty
				<p>No results found, sorry.</p
				@endforelse
			</div>
		</div>
	@endif
</div>
@endsection

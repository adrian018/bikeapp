@extends('layouts.app')
{{--  
@section('title', "{ $user->getNameOrUsername() }")
--}}
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-5">
				@include('blocks.userblock')
				<hr>
				 
				@forelse( $statuses as $status )
					<div class="row">

	                    <div class="col-xs-2">
	                        @include('blocks.statuses.useravatar')
	                    </div>
	                    <div class="col-xs-10">
	                        @include('blocks.statuses.content')
	                        @if( $is_friend || Auth::user() -> id === $status -> user -> id )
	                        	@include('blocks.statuses.replyform')
	                        @endif
	                    </div>
	                </div>
					<hr>
				@empty
					<p>{{ $user->getFirstNameOrUsername() }} hasn't posted anything yet.</p>
				@endforelse
				
			</div>
			
			<div class="col-lg-4 col-lg-offset-3">
				@if(Auth::check())
					@include('blocks.friendactions')
				@endif 
				<h4>{{ $user->getFirstNameOrUsername() }}'s friends</h4>

				@forelse($user->friends() as $user)
					@include('blocks.userblock')
				@empty
					<p>{{ $user->getFirstNameOrUsername() }} has no friends.</p>
				@endforelse
			</div>
		</div>		 
	</div>
	@stop

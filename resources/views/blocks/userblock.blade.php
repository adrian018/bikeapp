<div class="media">
	<div class="col-xs-2">
		<a href="{{ route( 'profile.index', [ 'username' => $user -> username ] ) }}" class="pull-left">
			<img src="{{ $user -> avatarUrl() }}" alt="" class="img-responsive">
		</a>
	</div>
	<div class="media-body">
		<h4 class="media-heading">
			<a href="{{ route( 'profile.index', [ 'username' => $user -> username ] ) }}" >
				{{ $user -> getNameOrUsername() }}
			</a>
		</h4>
		@if($user->location)
			<p>{{ $user->location }}</p>
		@endif
	</div>
</div>

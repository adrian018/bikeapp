<a class="pull-left" href="{{ route('profile.index', ['username' => $status->user->username]) }}">
	<img class="media-object img-responsive" alt="{{ $status->user->getNameOrUsername() }}" src="{{ $status->user->avatarUrl( $status -> user_id ) }}">
</a>

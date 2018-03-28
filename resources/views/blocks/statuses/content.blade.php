<h4 class="media-heading">
	<a href="{{ route('profile.index', ['username' => $status->user->username]) }}">{{ $status->user->getNameOrUsername() }}</a>
</h4>
<p>{{ $status->body }}</p>
<ul class="list-inline">
	<li>{{ $status->created_at->diffForHumans() }}</li>
	@if($status->user->id !== Auth::id())
		<li><a href="{{-- route('status.like', ['statusId' => $status->id]) --}}">Like</a></li>
	@endif
	{{--  <li>{{ $status->likes->count() }} {{ str_plural('like', $status->likes->count()) }}</li> --}}
</ul>

@foreach( $status -> replies as $reply )
<div class="row">
	<div class="media col-xs-2">
		<a class="pull-left" href="{{ route('profile.index', ['username' => $reply->user->username]) }}">
			<img class="media-object img-responsive" alt="{{ $reply->user->getNameOrUsername() }}" src="{{ $reply -> user -> avatarUrl() }}">
		</a>
	</div>
	<div class="media-body col-xs-10">
		<h5 class="media-heading">
			<a href="{{ route('profile.index', ['username' => $reply->user->username]) }}">{{ $reply->user->getNameOrUsername() }}</a>
		</h5>
		<p>{{ $reply->body }}</p>
		<ul class="list-inline">
			<li>{{ $reply->created_at->diffForHumans() }}</li>
			@if($reply->user->id !== Auth::id())
			<li><a href="{{-- route('status.like', ['statusId' => $reply->id]) --}}">Like</a></li>
			@endif
			<li>{{-- $reply->likes->count() }} {{ str_plural('like', $reply->likes->count()) --}}</li> 
		</ul>
		
	</div>
</div>	
@endforeach

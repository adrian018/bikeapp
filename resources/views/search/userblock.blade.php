<div class="media">
	<a href="" class="pull-left">
		<img src="{{ $user->avatar }}" alt="" class="media-object">
	</a>
	<div class="media-body">
		<h4 class="media-heading">
			<a href="">{{ $user -> getName() }}</a>
		</h4>
		@if($user->location)
			<p>{{ $user->location }}</p>
		@endif
	</div>
</div>

 <div class="container">
 	<div class="navbar-header">
 		<!-- Collapsed Hamburger -->
 		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
 			<span class="sr-only">Toggle Navigation</span>
 			<span class="icon-bar"></span>
 			<span class="icon-bar"></span>
 			<span class="icon-bar"></span>
 		</button>
 		<!-- Branding Image -->
 		<a class="navbar-brand" href="{{ url('/') }}">Bikes app</a>
 	</div>
 	<div class="collapse navbar-collapse" id="app-navbar-collapse">
 		<!-- Left Side Of Navbar -->
 		<ul class="nav navbar-nav">
 			<form action="{{ route('search.results') }}" class="navbar-form navbar-left" role="search">
 				<div class="form-group">
 					<input type="text" class="form-control" name="s" placeholder="Find people">
 				</div>
 				<button type="submit" class="btn btn-default">Search</button>
 			</form>
 		</ul>
 		<!-- Right Side Of Navbar -->
 		<ul class="nav navbar-nav navbar-right">
 			<!-- Authentication Links -->
 			@guest
 			<li><a href="{{ route('login') }}">Login</a></li>
 			<li><a href="{{ route('register') }}">Register</a></li>
 			@else
 			<li><a href="{{ route('timeline') }}">Timeline</a></li>
 			<li><a href="{{ route('tracks') }}">Tracks</a></li>
 			<li class="dropdown">
 				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >
 					{{ Auth::user() -> getFirstNameOrUsername() }}
 					<span class="dropdown-toggle caret" data-toggle="dropdown" role="button" aria-expanded="false"></span>
 				</a>
 				<ul class="dropdown-menu" role="menu">
 					<li><a href="{{ route( 'profile.index', [ 'username' => Auth::user() -> username ] ) }}" class="dropdown-toggle" >Profile</a></li>
 					<li><a href="{{ route( 'friend.index' ) }}">Friends</a></li>
 					<li><a href="{{ route( 'profile' ) }}"> Edit Profile</a></li>    
 					<li><a href="{{ route( 'logout' ) }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
 							Logout
 						</a>
 						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
 							{{ csrf_field() }}
 						</form>
 					</li>
 				</ul>
 				
 			</li>
 			
 			<img src="{{ Auth::user() -> avatarUrl() }}" alt="" id="user-img" class="img-responsive img-circle pull-right" />
 			@endguest
 		</ul>
 	</div>
</div>
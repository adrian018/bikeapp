<a href="profile/{{ $timeline -> user -> username }}">{{ $timeline -> user -> getNameOrUsername() }}</a> a adaugat cursa acum {{ $timeline -> created_at -> diffForHumans() }}
<img src="{{ $timeline -> avatarUrl( $timeline -> user_id ) }}" alt="" class="img-responsive img-rounded" />

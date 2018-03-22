<a href="profile/{{ $timeline -> user( $timeline -> user_id ) -> username }}">{{ $timeline -> user( $timeline -> user_id ) -> getNameOrUsername() }}</a> a adaugat cursa acum {{ $timeline -> created_at -> diffForHumans() }}
<img src="{{ $timeline -> avatarUrl( $timeline -> user_id ) }}" alt="" class="img-responsive img-rounded" />

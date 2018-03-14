<span style="text-decoration: underline;">{{ $timeline -> user( $timeline -> user_id ) -> name }}</span> a adaugat cursa acum {{ $timeline -> created_at -> diffForHumans() }}

<img src="{{ $timeline -> avatarUrl( $timeline -> user_id ) }}" alt="" class="img-responsive img-rounded" />

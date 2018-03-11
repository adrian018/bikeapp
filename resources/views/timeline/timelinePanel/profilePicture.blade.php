<span style="text-decoration: underline;">{{ $timeline -> user( $timeline -> user_id ) -> name }}</span> a adaugat cursa acum {{ $timeline -> created_at -> diffForHumans() }}

<img src="{{ $timeline -> user( $timeline -> user_id ) -> avatar == 'default.jpg' ? url('public/avatars/default.jpg') : url('public/avatars/' . $timeline ->  user_id . '/' .$timeline -> user( $timeline -> user_id ) -> avatar ) }}" alt="" class="img-responsive img-rounded" />

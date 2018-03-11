{{-- 
<span style="text-decoration: underline;">{{ $timeline -> user -> name }}</span> a adaugat cursa acum {{ $timeline -> created_at -> diffForHumans() }}

<img src="{{ $timeline -> user -> avatar == 'default.jpg' ? url('/public/avatars/default.jpg') : url('public/avatars/' . $timeline -> user -> id . '/' .  $timeline -> user -> avatar ) }}" alt="" class="img-responsive img-rounded" />
--}}
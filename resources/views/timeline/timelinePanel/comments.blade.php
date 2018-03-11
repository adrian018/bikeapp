  <div class="panel panel-white">
    <div class="post-heading">
      <div class="author-info">
        <div class="pull-left image">
        {{-- 
          <pre>
          @php
          $t = $timeline -> user;
          var_dump( $t );
          @endphp
          </pre>
     --}}  
 

         {{--   
          <img class="img-circle avatar" style="max-width: 100%;" src="{{  $timeline -> user -> avatar == 'default.jpg' ? url('public/avatars/default.jpg') : url('public/avatars/' . $timeline ->  user_id . '/' .$timeline -> user -> avatar ) }}" alt="" /> 
            
        </div>
        <div class="pull-left meta">
          <div class="title h5">
           <b>{{ $timeline -> user -> name }}</b> a adaugat un comentariu
         </div>
         <h6 class="text-muted time">Acum {{ $timeline -> created_at -> diffForHumans() }}</h6>
       </div>  

        --}}  
     </div>
   </div>    
   <div class="post-description">
    <p>{{ $comment -> comment }}</p>
  </div>
</div>   
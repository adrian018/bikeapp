  <div class="panel panel-white">
    <div class="post-heading">
      <div class="author-info">
        <div class="pull-left image">
              
          <img class="img-circle avatar" style="max-width: 100%;" src="{{  $timeline -> user( $comment -> user_id ) -> avatar == 'default.jpg' ? url('public/avatars/default.jpg') : url('public/avatars/' . $timeline ->  user_id . '/' .$timeline -> user( $comment -> user_id ) -> avatar ) }}" alt="" /> 
            
        </div>
        <div class="pull-left meta">
          <div class="title h5">
           <b>{{ $timeline -> user( $comment -> user_id ) -> name }}</b> a adaugat un comentariu
         </div>
         <h6 class="text-muted time">Acum {{ $comment -> created_at -> diffForHumans() }}</h6>
       </div>  

     </div>
   </div>    
   <div class="post-description">
    <p>{{ $comment -> comment }}</p>
  </div>
</div>   
<div class="panel panel-white">
  <div class="post-heading">
    <div class="author-info">
      <div class="pull-left image">  
        <img class="img-circle avatar" style="max-width: 100%;" src="{{ $timeline -> avatarUrl( $comment -> user_id ) }}" alt="" />  
      </div>
      <div class="pull-left meta">
        <div class="title h5">
         <b>{{ App\User::find( $comment -> user_id ) -> getNameOrUsername() }}</b> a adaugat un comentariu
       </div>
       <h6 class="text-muted time">Acum {{ $comment -> created_at -> diffForHumans() }}</h6>
     </div>  

   </div>
 </div>    
 <div class="post-description">
  <p>{{ $comment -> comment }}</p>
</div>
</div>   
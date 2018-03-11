<div class="row">
    <h3 class="text-center">Adauga un comentariu</h3>
    <form action="timeline" method="POST" >
        <div class="col-md-2 text-center thumbs" data-track="{{ $timeline -> id }}" data-user="{{  $timeline -> user_id }}">
           
            <input type="submit" value="Send" class="btn btn-primary">
        </div>
    <div class="col-md-10">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <input type="hidden" name="timeline_id" value="{{ $timeline -> id  }}">
        <textarea name="comment" style="width: 100%;" rows="3" class="form-control"></textarea>
    </div>
    </form>
</div>
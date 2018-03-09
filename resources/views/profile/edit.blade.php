@extends('layouts.app')

@section( 'custom-scripts' )

@endsection

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Editare Profil <br>
                    Bun venit, <a href="/profile/{{ $users -> id }}">{{ $users -> name }}</a>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="col-md-3">
                        <img src="{{ $users -> avatar != 'default.jpg' ?  url('/avatars/' . $users -> id . '/' . $users -> avatar ) : url('/avatars/default.jpg') }}" class="img-responsive" style="width: 300px;" /> 

                        <form enctype="multipart/form-data" action="/profile" method="POST">
                            <label>Update Profile Image</label>
                            <input type="file" name="avatar">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          

                        </div>
                        <div class="col-md-9">
                            <h2 class="page-title">Profile info</h2>
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="name">Name:</label>
                                    <div class="col-sm-6">
                                        <input name="name" type="text" class="form-control" required value="{{ $users -> name }}"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Email:</label>
                                    <div class="col-sm-6">
                                        <input name="email" type="email" class="form-control" required value="{{ $users -> email }}"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-sm-6 col-md-offset-2">
                                     <input type="submit" class="pull-left btn btn-sm btn-primary">
                                 </div>
                             </div>
                         </div>
                     </form>
                 </div>  
             </div>
         </div>
     </div>
 </div>
</div>

<div class="container">
   <div class="row">
    <div class="col-md-10 col-md-offset-2">

    </div>
</div>
</div>

@endsection

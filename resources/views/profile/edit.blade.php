@extends('layouts.app')

@section( 'custom-scripts' )

@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Editare Profil <br>
                    Bun venit, {{ $users -> getNameOrUsername() }}
                </div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="col-md-3">
                        <img src="{{ $users -> avatar != 'default.jpg' ?  url('/public/avatars/' . $users -> id . '/' . $users -> avatar ) : url('/public/avatars/default.jpg') }}" class="img-responsive" style="width: 300px;" /> 

                        <form enctype="multipart/form-data" action="{{ route('profile') }}" method="POST">
                            <label>Update Profile Image</label>
                            <input type="file" name="avatar">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                        <div class="col-md-9">
                            <div class="form-horizontal">
                                <div class="form-group{{ $errors -> has( 'first_name' ) ? ' has-error' : '' }}">
                                    <label class="control-label col-sm-2" for="first_name">First Name:</label>
                                    <div class="col-sm-6">
                                        <input name="first_name" type="text" class="form-control" value="{{ Auth::user() -> first_name ?: Request::old( 'first_name' ) }}" />
                                        @if( $errors -> has( 'first_name' ) )
                                            <span class="help-block">{{ $errors -> first( 'first_name' ) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-horizontal">
                                <div class="form-group{{ $errors -> has( 'last_name' ) ? ' has-error' : '' }}">
                                    <label class="control-label col-sm-2" for="last_name">Last Name:</label>
                                    <div class="col-sm-6">
                                        <input name="last_name" type="text" class="form-control" value="{{ Auth::user() -> last_name ?: Request::old( 'last_name' ) }}" />
                                        @if( $errors -> has( 'last_name' ) )
                                            <span class="help-block">{{ $errors -> first( 'last_name' ) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-horizontal">
                                <div class="form-group{{ $errors -> has( 'location' ) ? ' has-error' : '' }}">
                                    <label class="control-label col-sm-2" for="email">Location:</label>
                                    <div class="col-sm-6">
                                        <input name="location" type="text" class="form-control" value="{{ Auth::user() ->location ?: Request::old( 'location' ) }}" />
                                         @if( $errors -> has( 'location' ) )
                                            <span class="help-block">{{ $errors -> first( 'location' ) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-horizontal">
                                <div class="form-group{{ $errors -> has( 'email' ) ? ' has-error' : '' }}">
                                    <label class="control-label col-sm-2" for="email">Email:</label>
                                    <div class="col-sm-6">
                                        <input name="email" type="email" class="form-control" value="{{ Auth::user() ->email ?: Request::old( 'email' ) }}" />
                                         @if( $errors -> has( 'email' ) )
                                            <span class="help-block">{{ $errors -> first( 'email' ) }}</span>
                                        @endif
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

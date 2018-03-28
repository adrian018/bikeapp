@extends('layouts.app')

@section( 'custom-scripts' )

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDdLSrA9nIpqdBf2vPdkWFJL2Yi7diMCgI&libraries=geometry&sensor=true&ver=1.9"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.25/gmaps.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="{{ URL::asset('/public/js/timeline/timeline.js') }}"></script>

@endsection

@section( 'content' )
<div class="container">
    @if ( Auth::check() )
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <form action="{{ route('status.post') }}" method="post">
                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        <textarea placeholder="What's up {{ Auth::user()->getFirstNameOrUsername() }}?" name="status" class="form-control" rows="2"></textarea>
                        @if($errors->has('status'))
                            <span class="help-block">{{ $errors->first('status') }}</span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-default">Post status</button>
                    {!! csrf_field() !!}
                </form>
            </div>
        </div>
        <hr>
    @endif
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            @forelse($statuses as $status)
                <div class="row">
                    <div class="col-xs-2">
                        @include('blocks.statuses.useravatar')
                    </div>
                    <div class="col-xs-10">
                        @include('blocks.statuses.content')
                        @include('blocks.statuses.replyform')
                    </div>
                </div>
                <hr>
            @empty
                <p>There's nothing in your timeline yet.</p>
            @endforelse
        </div>
    </div>
  

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            {{ $statuses -> links() }}
        </div>
    </div>
</div>
@endsection

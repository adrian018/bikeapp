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
    @forelse( $timelines as $timeline )
    <div class="row">

        <div class="col-md-3">
            {{-- profile picture --}}
            @include('timeline.timelinePanel.profilePicture')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Cursa {{ $timeline -> info[0]  }}
                </div>
                <div class="panel-body">
                      @include( 'timeline.timelinePanel.map' )
                </div>
                <div class="panel-footer clearfix">
                  
                    @include( 'timeline.timelinePanel.addComment' )
                   
                    @if( count( $timeline -> comments ) > 0 ) 
                        
                        @foreach( $timeline -> comments as $comment )
                            <section class="row post" id="comment-{{ $comment -> id }}">
                                @include( 'timeline.timelinePanel.comments' )
                            </section>
                        @endforeach

                    @endif
                    
                    @include( 'timeline.timelineFooter.status' ) 

                </div>
            </div>
        </div>
    </div>
    @empty
    Timeline Gol :(
    @endforelse

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            {{ $timelines -> links() }}
        </div>
    </div>
</div>
@endsection

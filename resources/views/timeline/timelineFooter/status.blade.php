      <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="img-container pull-left">
                                <img src="{{ url('public/images/ic_track_avg_speed_large.png') }}" alt="">
                            </div>
                            <div class="info">
                                <span class="muted">Viteza medie</span> <br>
                                <span style="color: #1b8b43">{{ $timeline -> info[ 1 ]  }} km/h</span>
                            </div>
                                
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="img-container pull-left">
                                <img src="{{ url('public/images/ic_track_max_speed_large.png') }}" alt="">
                            </div>
                            <div class="info">
                                <span class="muted">Viteza Maxima </span> <br>
                                <span style="color: #ea057a">{{ $timeline -> info[ 2 ]  }} km/h</span>
                            </div>
                                
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="img-container pull-left">
                                <img src="{{ url('public/images/ic_track_time_large.png') }}" alt="">
                            </div>
                            <div class="info">
                                <span class="muted">Durata</span> <br>
                                <span style="color: #42a5c2">{{ $timeline -> info[ 3 ]  }} minute</span>
                            </div>
                                
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="img-container pull-left">
                                <img src="{{ url('public/images/ic_track_distance_large.png') }}" alt="">
                            </div>
                            <div class="info">
                                <span class="muted">Distanta</span> <br>
                                <span style="color: #7cc242"> {{ $timeline -> info[ 4 ]  }} km</span>
                            </div>
                                
                        </div>
                    </div>   
@extends('layouts.app')

@section('content')

    @include('pages/_navbar')
    <div class="container spark-screen reportcontainer">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$genre}} shows on {{$date}} in {{$city}}</div>

                        <div class="panel-body">
                            @foreach($events as $event)
                            <div class="row" style="padding-bottom:10px;">
                                <div class="col-md-6">
                                    <h1>{{$event['artist_name']}}</h1>
                                    <h6><strong>Venue:  </strong>{{$event['venue_name']}}</h6>
                                    <h6><strong>Time:  </strong>{{$event['time']}}</h6>
                                    <h6><strong>Event:  </strong>{{$event['event_name']}}</h6>
                                    <h6><strong>Genres: </strong>
                                        @foreach($event['genres'] as $genre)
                                            {{$genre}},
                                        @endforeach
                                    </h6>

                               </div>
                               <div class="col-md-6">

                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="{{$event['youtube_link']}}"></iframe>
                                    </div>
                               </div>
                               <br/>
                            </div>

                            @endforeach
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

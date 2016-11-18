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
                            <div class="row">
                                <div class="col-md-6">
                                    <h1>{{$event['artist_name']}}</h1>
                                    <h6><strong>Venue:  </strong>{{$event['venue_name']}}</h6>
                                    <h6><strong>Time:  </strong>{{$event['time']}}</h6>
                                    <h6><strong>Event:  </strong>{{$event['event_name']}}</h6>

                               </div>
                               <div class="col-md-6">
                                    <a class="embedly-card" data-card-key="191f814144764bc5942760e96b88e4b8" data-card-controls="0" href="{{$event['youtube_link']}}">{{$event['artist_name']}}</a>


                               </div>
                            </div>

                            @endforeach
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

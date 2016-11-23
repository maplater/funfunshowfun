@extends('layouts.app')

@section('content')

    @include('pages/_navbar')

    <div class="container spark-screen reportcontainer">
        <div class="row">
            @include('flash::message')
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">


                    <div class="panel-body">
                        {!! Form::open(['url' => 'search']) !!}

                        <div class="form-group">
                            {!! Form::label('city','City (e.g. San Francisco) Larger cities may take a few extra moments to search:') !!}
                            {!! Form::text('city', null, ['class' => 'form-control']) !!}
                        </div>



                        <div class=form-group">
                            {!! Form::label('genre','Genre(s) (indie, pop, trap, hip hop, etc..):') !!}
                            {!! Form::text('genre', null, ['class' => 'form-control']) !!}

                        </div><br/>
                        <div class=form-group">
                                                    {!! Form::label('date','Date:') !!}
                                                    {!! Form::date('date', \Carbon\Carbon::now()) !!}

                            </div>
                            <br/>
                        <div class="form-group">

                            {!! Form::submit("Search", ['class' => 'btn btn-primary form-control']) !!}
                        </div>

                        {!! Form::close() !!}

                        @include('errors.list')

                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <img width=100% src="{{url('/img/hero.png')}}" align="middle">
            </div>
            <div class="col-md-1">

            </div>
            <div class="col-md-5">
                <h1>Discover where your favorite kind of music playing</h1>
                <h3>Search a city for shows playing any kind of genre.</h3>
            </div>
        </div>
    </div>
@endsection

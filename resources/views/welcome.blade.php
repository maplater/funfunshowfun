@extends('layouts.app')

@section('content')

    @include('pages/_navbar')

    <div class="container spark-screen reportcontainer">
        <div class="row">
            @include('flash::message')
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Search for live music by the genre</div>

                    <div class="panel-body">
                        {!! Form::open(['url' => 'search']) !!}

                        <div class="form-group">
                            {!! Form::label('city','City (e.g. New York City):') !!}
                            {!! Form::text('city', null, ['class' => 'form-control']) !!}
                        </div>



                        <div class=form-group">
                            {!! Form::label('genre','Genre (hip hop, pop, jazz, indie small genre no one has ever heard of..., etc..):') !!}
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
    </div>
@endsection

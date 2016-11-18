@extends('layouts.app')

@section('content')

    @include('pages/_navbar')
    <div class="container spark-screen reportcontainer">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Select one</div>

                    <div class="panel-body">
                        {!! Form::open(['url' => 'reports']) !!}

                        @foreach($cityList as $location)

                            <div class="form-group">
                                {!! Form::radio('name',$location['name']) !!}

                                {{$location['name'] }}

                                {!! form::hidden($location['name'],$location['id']) !!}
                            </div>

                        @endforeach

                        {!! Form::submit('Submit',['class' => 'btn btn-primary form-control']) !!}

                        {!! Form::close() !!}

                        @include('errors.list')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

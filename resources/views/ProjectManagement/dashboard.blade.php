@extends('layouts/project',['title'=>'Dashboard'])

@section('content')


    @if(session('message'))
        <div class="alert alert-danger" role="alert">
            {{session('message')}}
        </div>
    @endif

@foreach($data as $project)
    <div class="card">
        <h5 class="card-header">Project Information</h5>
        <div class="card-body">



            <div class="row justify-content-between">

                <div class="col-2">
                    <h5 class="card-title"> {{$project['title']}}</h5>
                </div>
                <div class="col-4">
                    <h5 class="card-title">Start Date: {{$project['start_date']}} </h5>
                </div>


            </div>



            <div class="row justify-content-between">

                <div class="col-4">
                    <p class="card-text"> {{$project['description']}}</p>
                </div>
                <div class="col-4">
                    <h5 class="card-title">End Date: {{$project['end_date']}}</h5>
                </div>


            </div>

            <a href="/closeProject" class="btn btn-danger">Close Project</a>
        </div>
    </div>
@endforeach

@endsection

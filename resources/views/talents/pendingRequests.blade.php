@extends('layouts/talentAdmin',['title'=>'Pending Requests'])


@section('content')



    @if(session('message'))
        <div class="alert alert-danger" role="alert">
            {{session('message')}}
        </div>
    @endif


    <div class="card">
        <div class="card-header">
          Hire Requests
        </div>
        <div class="card-body">



                    @forelse($requests as $project)
                    <div class="card">
                        <h5 class="card-header">{{$project['project_title']}}</h5>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text"> <strong>Project Title: </strong>  {{$project['project_title']}}</p>
                            <p class="card-text"> <strong>Project description: </strong>  {{$project['project_desc']}}</p>
                            <p class="card-text"> <strong>Start date:</strong> {{$project['start_date']}}</p>
                            <p class="card-text"> <strong>End date:</strong> {{$project['end_date']}}</p>
                            <p class="card-text"> <strong>Total Price:</strong>{{$project['total_price']}}  </p>

                            <p class="card-text"> <strong>Project Manager Email:</strong> {{$project['email']}}  </p>



                            <a  href="{{ route('talentAccept', ['project_id' => $project['project_id'], 'id' => $project['id']]) }}" class="btn btn-primary">Accept</a>
                            <a href="{{ route('talentReject', ['project_id' => $project['project_id'], 'id' => $project['id']]) }}" class="btn btn-danger">Reject</a>


                        </div>

                    </div>
                        <br>

            @empty

                <br>
                <br>

                <h2 style="color: darkgray"  class="text-center font-weight-light">You haven't received any hire requests yet </h2>

                <br>
                <br>


            @endforelse







        </div>
    </div>

@endsection




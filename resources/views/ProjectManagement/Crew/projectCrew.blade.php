@extends('layouts/project',['title'=>'Project Crew'])

@section('content')

    <style>
        .cards {
            margin-top: 2em;
            padding: 1.5em 0.5em 0.5em;
            border-radius: 2em;
            text-align: center;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
        .card img {
            width: 65%;
            border-radius: 50%;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .card .card-title {
            font-weight: 700;
            font-size: 1.5em;
        }

        .card .btn {
            border-radius: 2em;
            background-color: black;
            color: #ffffff;
            padding: 0.5em 1.5em;
        }
        .card .btn:hover {
            background-color: teal;
            color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

    </style>


    @if(session('message'))
        <div class="alert alert-success" role="alert">
            {{session('message')}}
        </div>
    @endif

    @if(session('message2'))
        <div class="alert alert-success" role="alert">
            {{session('message2')}}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
           The crew of the Project
        </div>
        <div class="card-body">

            <div class="container mx-auto mt-4">
                <div class="row">

                    @forelse($requests as $talent)
                        <div class="col-md-4">
                            <div class="cards" style="width: 18rem; ; ">
                                <img src="{{asset('storage/talentsPictures/'.$talent['picture'])}}" class="card-img-top" alt="..." style="height:230px " >
                                <div class="card-body">
                                    <h5 class="card-title">{{$talent['name']}}</h5>
                                    <p class="card-text"> <strong>Profession: </strong>  {{$talent['profession']}}</p>
                                    <p class="card-text"> <strong>Start date:</strong> {{$talent['start_date']}}</p>
                                    <p class="card-text"> <strong>End date:</strong> {{$talent['end_date']}}</p>
                                    <p class="card-text"> <strong>Total Price:</strong>{{$talent['total_price']}}  </p>
                                    <p class="card-text"> <strong>Phone:</strong> {{$talent['phone']}}  </p>

                                    @if($talent['paid'] == 'no')
                                        <form method="post" action="/talentsPayment">
                                            @csrf
                                            <input type="hidden" value="{{$talent['id']}}" name="hire_request_id">
                                            <button type="submit" class="btn btn-primary">Pay</button>
                                        </form>

                                    @else
                                        <h5 style="text-transform: capitalize; color: Red "  ><strong> Paid</strong></h5>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty


                        <h2 style="color: darkgray"  class="text-center font-weight-light">This project have no crew </h2>


                    @endforelse

                </div>
            </div>





        </div>
    </div>

@endsection

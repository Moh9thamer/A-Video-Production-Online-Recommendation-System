@extends('layouts/locationsAdmin',['title'=>'Rented Locations'])

@section('content')



    <div class="card">
        <div class="card-header">
            Rented Locations
        </div>
        <div class="card-body">

            @if(session('message'))
                <div class="alert alert-success" role="alert">
                    {{session('message')}}
                </div>
            @endif
            <div class="container mx-auto mt-4">
                <div class="row">


                    @forelse($requests as $location)
                        <div class="col-md-4 " >
                            <div class="card" style="width: 18rem; margin-bottom: 2rem">
                                <img class="card-img-top" src="{{asset('storage/locations/'.$location['image'])}}" alt="Card image cap" style="height: 200px">
                                <div class="card-body">
                                    <p class="card-text">{{$location['description']}}</p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <p> <strong> Start date:</strong> {{$location['start_date']}}</p>
                                        <p> <strong> End date:</strong> {{$location['end_date']}}</p>
                                    </li>

                                    <li class="list-group-item">
                                        <p><strong>Tenant information:</strong></p>
                                        <p><strong>Name:</strong>  {{$location['name']}}</p>
                                        <p><strong>Email:</strong>  {{$location['email']}}</p>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    @empty
                        <br>
                        <br>

                        <h2 style="color: darkgray"  class="text-center font-weight-light">There are no renting requests </h2>

                        <br>
                        <br>
                    @endforelse

                </div>

            </div>
        </div>
    </div>


@endsection

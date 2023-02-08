@extends('layouts/equipmentsAdmin',['title'=>'Rent Orders'])



@section('content')


    <div class="card">
        <div class="card-header">
            Rented Equipments
        </div>
        <div class="card-body">

            @if(session('message'))
                <div class="alert alert-success" role="alert">
                    {{session('message')}}
                </div>
            @endif
            <div class="container mx-auto mt-4">
                <div class="row">


                    @forelse($requests as $equipment)
                        <div class="col-md-4 " >
                            <div class="card" style="width: 18rem; margin-bottom: 2rem">
                                <img class="card-img-top" src="{{asset('storage/equipments/'.$equipment['image'])}}" alt="Card image cap" style="height: 200px">
                                <div class="card-body">
                                    <p class="card-text">{{$equipment['description']}}</p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <p> <strong> Pick-up date:</strong> {{$equipment['start_date']}}</p>
                                        <p> <strong> Drop-off date:</strong> {{$equipment['end_date']}}</p>
                                    </li>

                                    <li class="list-group-item">
                                        <p><strong>Tenant information:</strong></p>
                                        <p><strong>Name:</strong>  {{$equipment['name']}}</p>
                                        <p><strong>Email:</strong>  {{$equipment['email']}}</p>

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





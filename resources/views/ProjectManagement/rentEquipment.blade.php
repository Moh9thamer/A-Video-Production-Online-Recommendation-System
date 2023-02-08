@extends('layouts/project',['title'=>'Rent Equipments'])

@section('content')


    <div class="card">
        <div class="card-header">
            Quote
        </div>
        <div class="card-body">
            @if(session('rented1'))
                <div class="alert alert-danger" role="alert">
                    {{session('rented1')}}
                </div>
            @endif


            @if(session('error1'))
                <div class="alert alert-danger" role="alert">
                    {{session('error1')}}
                </div>
            @endif

                @if(session('error2'))
                    <div class="alert alert-danger" role="alert">
                        {{session('error2')}}
                    </div>
                @endif
            <div class="row justify-content-md-center">
                <div class="col-md-4 " >
                    @foreach($data as $equipment)
                       <div class="card mb-3" >
                        <img class="card-img-top" src="{{asset('storage/equipments/'.$equipment['image'])}}" alt="Card image cap" >
                        <div class="card-body">
                            <h5 class="card-title">{{$equipment['name']}}</h5>
                            <p class="card-text">{{$equipment['description']}}</p>
                            <h5 class="card-title" style="color: #0d6efd;">BHD{{$equipment['price']}} per day</h5>


                            <form action="/equipmentsPayment" method="post">
                                @csrf

                                <input type="hidden" name="price" value="{{$equipment['price']}}">
                                <input type="hidden" name="equipment_id" value="{{$equipment['id']}}">
                                <div class="input-group ">
                                    <div class="input-group-prepend ">
                                        <span class="input-group-text" id="validationTooltipUsernamePrepend">Pick-Up Date</span>
                                    </div>
                                    <input type="date" name="start_date" class="form-control" placeholder="Enter project title" required>

                                </div>
                                <br>

                                <div class="input-group ">
                                    <div class="input-group-prepend ">
                                        <span class="input-group-text" id="validationTooltipUsernamePrepend">Drop-Off Date</span>
                                    </div>
                                    <input type="date" name="end_date" class="form-control" placeholder="Enter project title" required>
                                </div>

                                <br>

                                <p class="card-text">
                                    <strong>Pick-Up Time:</strong> at 07:00 am
                                    &nbsp;
                                    &nbsp;
                                    &nbsp;
                                    &nbsp;
                                    <strong>Drop-Off Time:</strong> at 09:00 pm

                                </p>

                                <button class="btn btn-dark btn-lg"  type="submit">Continue</button>

                            </form>
                        </div>
                    </div>
                        @endforeach
                </div>



            </div>

        </div>
    </div>






@endsection

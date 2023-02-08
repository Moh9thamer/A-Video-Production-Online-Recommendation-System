@extends('layouts/project',['title'=>'Rent Equipments'])

@section('content')



    <div class="card">
        <div class="card-header">
            Equipments
        </div>
        <div class="card-body">

            <!--  start -->




            <div class="container mx-auto mt-4">
                <div class="row">






                    @forelse($equipments as $equipment)
                        <div class="col-md-4">
                            <div class="card " style="width: 18rem; margin-bottom: 2rem">
                                <img class="card-img-top" src="{{asset('storage/equipments/'.$equipment['image'])}}" alt="Card image cap" style="height:230px ">
                                <div class="card-body">
                                    <h5 class="card-title">{{$equipment['name']}}</h5>
                                    <p class="card-text">{{$equipment['description']}}</p>
                                    <h5 class="card-title">{{$equipment['price']}}BD per day</h5>
                                    <a href="{{'equipmentDetails/'.$equipment['id']}}" class="btn btn-dark">Rent</a>
                                </div>
                            </div>
                        </div>

                        @empty
                            <br>
                            <br>

                            <h2 style="color: darkgray"  class="text-center font-weight-light">There are no equipments to rent </h2>

                            <br>
                            <br>
                    @endforelse

                </div>
            </div>


            <!--  end -->
        </div>



    </div>




@endsection

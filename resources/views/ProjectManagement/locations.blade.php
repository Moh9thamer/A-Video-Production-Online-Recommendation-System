@extends('layouts/project',['title'=>'Rent Locations'])

@section('content')



    <div class="card">
        <div class="card-header">
            Locations
        </div>
        <div class="card-body">

            <!--  start -->




            <div class="container mx-auto mt-4">
                <div class="row">



                   @forelse($locations as $location)
                    <div class="col-md-4">
                        <div class="card " style="width: 18rem; margin-bottom: 2rem ">
                            <img class="card-img-top" src="{{asset('storage/locations/'.$location['image'])}}" alt="Card image cap" style="height:230px ">
                            <div class="card-body">
                                <h5 class="card-title">{{$location['name']}}</h5>
                                <p class="card-text">{{$location['description']}}</p>
                                <h5 class="card-title">{{$location['price']}}BD per day</h5>
                                <a href="{{'locationDetails/'.$location['id']}}" class="btn btn-dark">Rent</a>
                            </div>
                        </div>
                    </div>

                    @empty
                        <br>
                        <br>

                        <h2 style="color: darkgray"  class="text-center font-weight-light">There are no locations to rent </h2>

                        <br>
                        <br>
                    @endforelse

                </div>
            </div>


            <!--  end -->
        </div>



    </div>




@endsection

@extends('layouts.project',['title'=>'Hire a Crew'])

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
        background-color: teal;
        color: #ffffff;
        padding: 0.5em 1.5em;
    }
    .card .btn:hover {
        background-color: rgba(0, 128, 128, 0.7);
        color: #ffffff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
</style>

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#description" role="tab" aria-controls="description" aria-selected="true">Talents</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="#history" role="tab" aria-controls="history" aria-selected="false">Recommended Talents</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">


                        <div class="tab-content mt-3">
                            <div class="tab-pane active" id="description" role="tabpanel">
                                <div class="container mx-auto mt-4">
                                    <div class="row">

                                        @foreach($talents as $talent)
                                        <div class="col-md-4">
                                            <div class="cards" style="width: 18rem; ;  height: 500px">
                                                <img src="{{asset('storage/talentsPictures/'.$talent['picture'])}}" class="card-img-top" alt="..." style="height:230px " >
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$talent['name']}}</h5>
                                                    <p class="card-text"> <strong>Profession:</strong> {{$talent['profession']}} </p>
                                                    <p class="card-text"> <strong>Daily Rate:</strong> {{$talent['daily_Rate']}}BHD  </p>



                                                    <a href="{{'talentDetails/'.$talent['id']}}" class="btn btn-primary">Details & Hire</a>
                                                </div>
                                            </div>
                                        </div>


                                        @endforeach

                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="history" role="tabpanel" aria-labelledby="history-tab">
                                <div class="container mx-auto mt-4">
                                    <div class="row">

                                        @forelse($recommends as $talent)
                                            <div class="col-md-4">
                                                <div class="cards" style="width: 18rem; ;  height: 500px">
                                                    <img src="{{asset('storage/talentsPictures/'.$talent['picture'])}}" class="card-img-top" alt="..." style="height:230px " >
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{$talent['name']}}</h5>
                                                        <p class="card-text"> <strong>Profession:</strong> {{$talent['profession']}} </p>
                                                        <p class="card-text"> <strong>Daily Rate:</strong> {{$talent['daily_Rate']}}BHD  </p>



                                                        <a href="{{'talentDetails/'.$talent['id']}}" class="btn btn-primary">Details & Hire</a>
                                                    </div>
                                                </div>
                                            </div>

                                           @empty

                                            <br>
                                            <br>

                                            <h2 style="color: darkgray"  class="text-center font-weight-light">We don't have any recommendation for your project </h2>

                                            <br>
                                            <br>
                                        @endforelse

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>





@endsection

@extends('layouts/main2')


@section('content')


    <body style="background-color:whitesmoke">
    <section id="gallery">

            @if(session('Equmessage'))
                <div class="alert alert-success" role="alert">
                    {{session('Equmessage')}}
                </div>
            @endif

                @if(session('Locmessage'))
                    <div class="alert alert-success" role="alert">
                        {{session('Locmessage')}}
                    </div>
                @endif
            <div class=" row pt-5 m-auto justify-content-center">
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <img src="{{asset('img/locations.jpg')}}" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Locations</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ut eum similique repellat a laborum, rerum voluptates ipsam eos quo tempore iusto dolore modi dolorum in pariatur. Incidunt repellendus praesentium quae!</p>

                            @if($status == 'pending')
                            <a  class="btn btn-outline-danger btn-sm">Request: Pending</a>
                                @elseif($status == 'accepted')
                                <a href="locationsDashboard" class="btn btn-outline-warning btn-sm">Manage your locations</a>
                                <a  class="btn btn-outline-success btn-sm">Request: Accepted</a>
                            @elseif($status == 'no_request')
                                <a href="locationRequest"  class="btn btn-outline-warning btn-sm">Send Your Request</a>
                                @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <img src="{{asset('img/img1.jpg')}}" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Equipments</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ut eum similique repellat a laborum, rerum voluptates ipsam eos quo tempore iusto dolore modi dolorum in pariatur. Incidunt repellendus praesentium quae!</p>

                            @if($status2 == 'pending')
                                <a  class="btn btn-outline-danger btn-sm">Request: Pending</a>
                            @elseif($status2 == 'accepted')
                            <a href="equipmentsDashboard" class="btn btn-outline-warning btn-sm">Manage your equipments</a>
                                <a  class="btn btn-outline-success btn-sm">Request: Accepted</a>

                            @elseif($status2 == 'no_request')
                                <a href="equipmentRequest" class="btn btn-outline-warning btn-sm">Send Your Request</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

    </section>
    </body>





@endsection

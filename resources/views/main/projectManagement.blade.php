@extends('layouts/main2')


@section('content')


<body style="background-color: whitesmoke">


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">


<section>


<div class="container" >

    @if(session('message'))
        <div class="alert alert-success" role="alert">
            {{session('message')}}
        </div>
    @endif

        @if(session('message1'))
            <div class="alert alert-success" role="alert">
                {{session('message1')}}
            </div>
        @endif

    <div class=" pt-5 m-auto justify-content-center">

    <div class="card">
        <a   href="projectForm" class="btn btn-dark btn-lg btn-block" >
            <i class="bi bi-plus-circle"></i> New Project
        </a>

        <div class="card-header" style="background-color: ghostwhite">
            <h4>Projects</h4>
        </div>

        <div class="card-body">


                    @forelse ($projects as $project)
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{'projectDashboard/'.$project['id']}}" style="color: black; text-decoration: none">
                            <div class="card mb-3" style="background-color: #FFCD17" >
                                <div class="row no-gutters">
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><strong>{{$project['title']}}</strong></h5>
                                            <p class="card-text"><small class="text-muted">End date: {{$project['end_date']}} </small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

            @empty
                        <br>
                <br>
                <h2 style="color: darkgray"  class="text-center font-weight-light">Create a project and start managing it </h2>
                        <br>
                        <br>
            @endforelse


            </div>
        </div>
    </div>
</div>




</section>



</body>


@include('vendors.equipments.addEquipment')
@endsection

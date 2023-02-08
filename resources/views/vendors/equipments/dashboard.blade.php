@extends('layouts/equipmentsAdmin',['title'=>'Dashboard'])

@section('content')





    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Equipments List</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$c2}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-location-arrow fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Rented Equipments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$c1}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-location-arrow fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

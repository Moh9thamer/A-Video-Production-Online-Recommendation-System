@extends('layouts/locationsAdmin',['title'=>'Locations List'])

@section('content')

    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">






        @if(session('message'))
            <div class="alert alert-success" role="alert">
                The Location has been deleted successfully.
            </div>
        @endif

        @if(session('Locmessage'))
            <div class="alert alert-success" role="alert">
                {{session('Locmessage')}}
            </div>
        @endif



        <div class="float-right">
            <a href="#"  data-toggle="modal" data-target="#ModalCreate">
                <button type="button" class="btn btn-dark"><i class="bi bi-plus-circle"></i></button>
            </a>
        </div><br><br>

        <table id="datatable" class="table" >
            <thead class="table-dark">
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Operations</th>
            </thead>
            <tbody>

            @foreach($locations as $location)
            <tr>
                <td>{{$location['id']}}</td>
                <td><img src="{{asset('storage/locations/'.$location['image'])}}"  class="rounded"  style="height: 170px; width: 200px" ></td>
                <td>{{$location['name']}}</td>
                <td>{{$location['description']}}</td>
                <td>{{$location['price']}}</td>
                <td>

                   <!-- <a class="btn btn-success" href="#"  data-toggle="modal" data-target="#updateModal"  role="button"><i class="bi bi-pencil-square"></i></a> -->
                <!--  <a class="btn btn-primary" href="#"   role="button"><i class="bi bi-pen"></i></a>-->
                    <a class="btn btn-danger" href="{{'deleteLocation/'.$location['id']}}" role="button"><i class="bi bi-trash"></i></a>

                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{$locations->links()}}


 @include('vendors.locations.addLocation')




@endsection


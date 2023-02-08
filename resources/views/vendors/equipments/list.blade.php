@extends('layouts/equipmentsAdmin',['title'=>'Equipments List'])

@section('content')

    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">





        @if(session('message'))
            <div class="alert alert-success" role="alert">
                The Equipment has been deleted successfully.
            </div>
        @endif

        @if(session('Eqmessage'))
            <div class="alert alert-success" role="alert">
                {{session('Eqmessage')}}
            </div>
        @endif



        <div class="float-right">
            <a href="#"  data-toggle="modal" data-target="#ModalCreate">
                <button type="button" class="btn btn-dark"><i class="bi bi-plus-circle"></i></button>
            </a>
        </div><br><br>

        <table id="datatable" class="table table-striped" >
            <thead class="table-dark">
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Operations</th>
            </thead>
            <tbody>

            @foreach($equipments as $equipment)
                <tr>
                    <td>{{$equipment['id']}}</td>
                    <td><img src="{{asset('storage/equipments/'.$equipment['image'])}}"  class="rounded"  style="height: 170px; width: 200px" ></td>
                    <td>{{$equipment['name']}}</td>
                    <td>{{$equipment['description']}}</td>
                    <td>{{$equipment['price']}}</td>
                    <td>

                        <!-- <a class="btn btn-success" href="#"  data-toggle="modal" data-target="#updateModal"  role="button"><i class="bi bi-pencil-square"></i></a> -->
                        <a class="btn btn-danger" href="{{'deleteEquipments/'.$equipment['id']}}" role="button"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$equipments->links()}}


    @include('vendors.equipments.addEquipment')





@endsection


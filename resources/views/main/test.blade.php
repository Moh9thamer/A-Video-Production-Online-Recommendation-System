@extends('layouts/project')


@section('content')


    <div class="container">


        @if(session('user'))
            <div class="alert alert-success" role="alert">
                The user has been added successfully.
            </div>
        @endif

        @if(session('message'))
            <div class="alert alert-success" role="alert">
                The user has been deleted successfully.
            </div>
        @endif

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users List</h1>
        </div>

        <div class="float-right">
            <a href="#"  data-toggle="modal" data-target="#ModalCreate">
                <button type="button" class="btn btn-dark"><i class="bi bi-person-plus"></i></button>
            </a>
        </div><br><br>

        <table class="table">
            <thead class="table-dark">
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Operations</th>
            </thead>
            <tbody>

            </tbody>
        </table>





    </div>


    @include('main.modalProjectManagement')
@endsection

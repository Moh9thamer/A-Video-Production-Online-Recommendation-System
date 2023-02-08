
@extends('layouts.admin',['title'=>'Admins List'])


@section('content')





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

        <div class="float-right">
            <a href="#"  data-toggle="modal" data-target="#ModalCreate">
            <button type="button" class="btn btn-dark"><i class="bi bi-person-plus"></i></button>
            </a>
        </div><br><br>

        <table  class="table table-striped table-dark">
            <thead class="table-dark">
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Operations</th>
            </thead>
            <tbody>
            @foreach($admins as $admin)
                <tr>
            <td>{{$admin['id']}}</td>
            <td>{{$admin['name']}}</td>
            <td>{{$admin['email']}}</td>
                    <td>
                        <a href={{"deleteUser/".$admin['id']}}>
                        <button type="button" class="btn btn-danger"> Delete </button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>



   {{$admins->links()}}




@include('admin.Users.addUser')
@endsection


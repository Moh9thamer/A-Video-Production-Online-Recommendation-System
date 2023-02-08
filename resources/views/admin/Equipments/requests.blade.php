@extends('layouts.admin',['title'=>'Equipment Requests'])


@section('content')



        @if(session('message'))
            <div class="alert alert-success" role="alert">
                {{session('message')}}
            </div>
        @endif


        <table class="table">
            <thead class="table-dark">

            <th>ID</th>
            <th>User_ID</th>
            <th>Phone</th>
            <th>License</th>
            <th>Status</th>
            <th> operations</th>
            </thead>
            <tbody>
            @foreach($requests as $request)
                <tr>
                    <td>{{$request['id']}}</td>
                    <td>{{$request['user_id']}}</td>
                    <td>{{$request['phone']}}</td>
                    <td><a href="{{asset('storage/equipmentRequests/'.$request['license'])}}">License</a></td>
                    <td> <p class="text-danger font-weight-bold">{{$request['status']}}</p></td>

                    <td>
                        <a href='acceptEqRequest/{{$request['id']}}'>
                            <button type="button" class="btn btn-primary"> Accept </button>
                        </a>
                        <a href=deleteEqRequest/{{$request['id']}}>
                            <button type="button" class="btn btn-danger"> Reject </button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>



@endsection

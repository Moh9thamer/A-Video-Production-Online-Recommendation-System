@extends('layouts.admin',['title'=>'Talent List'])



@section('content')

    <div class="container-fluid">





            @if(session('message'))
                <div class="alert alert-success" role="alert">
                    {{session('message')}}
                </div>
            @endif



            <table class="table">
                <thead class="table-dark">

                <th>ID</th>
                <th>Picture</th>
                <th>Phone</th>
                <th>Profession</th>
                <th> operations</th>
                </thead>
                <tbody>
                @foreach($data as $talent)
                    <tr>
                        <td>{{$talent['id']}}</td>
                        <td><img src="{{asset('storage/talentsPictures/'.$talent['picture'])}}" alt="..." class="img-thumbnail" style="height: 100px ; width: 70px"></td>
                        <td>{{$talent['phone']}}</td>
                        <td>{{$talent['profession']}}</td>
                        <td>
                            <a href='deleteTalent/{{$talent['id']}}'>
                                <button type="button" class="btn btn-danger"> Delete</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                {{$data->links()}}

        </div>



        @endsection





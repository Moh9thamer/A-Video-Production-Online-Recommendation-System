

@extends('layouts/main2')


@section('content')




    <body style="background-color:whitesmoke">
    <section id="gallery" >

        <div class=" row pt-5 m-auto justify-content-center">

            <div class="col-lg-4 mb-4">

                @if(session('error2'))
                    <div class="alert alert-danger" role="alert">
                        {{session('error2')}}
                    </div>
                @endif

                    @if(session('error1'))
                        <div class="alert alert-danger" role="alert">
                            {{session('error1')}}
                        </div>
                    @endif

                <div class="card">
                    <img src="{{asset('img/2.jpg')}}" alt="" class="card-img-top">
                    <div class="card-body">

                        <form method="post" action="saveProjectInfo" enctype="multipart/form-data">
                            @csrf
                            <h5 class="card-title">Project Information</h5>


                            <div class="input-group ">
                                <div class="input-group-prepend ">
                                    <span class="input-group-text" id="validationTooltipUsernamePrepend">Title</span>
                                </div>
                                <input type="text" name="title" class="form-control" placeholder="Enter project title" required>

                            </div>

                            <br>

                            <div class="">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> Description</span>
                                </div>
                                <textarea class="form-control" aria-label="With textarea" name="desc"></textarea>
                            </div>
                            <br>


                            <div class="input-group ">
                                <div class="input-group-prepend ">
                                    <span class="input-group-text" id="validationTooltipUsernamePrepend">Start Date</span>
                                </div>
                                <input type="date" name="start_date" class="form-control" placeholder="Enter project title" required>

                            </div>
                            <br>

                            <div class="input-group ">
                                <div class="input-group-prepend ">
                                    <span class="input-group-text" id="validationTooltipUsernamePrepend">End Date </span>
                                </div>
                                <input type="date" name="end_date" class="form-control" placeholder="Enter project title" required>

                            </div>

                            <br>
                            <br>

                            <div class="mx-auto" style="width: 200px;">
                                <button type="submit" class="btn btn-dark">Create</button>
                                <button type="button" class="btn btn-dark"><a href="projectManagement" style="color: white ; text-decoration: none;">Cancel</a></button>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>

    </section>
    </body>


@endsection


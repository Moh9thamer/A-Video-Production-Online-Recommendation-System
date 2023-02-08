@extends('layouts/main2')

@section('content')



    <section id="gallery" class="bg-dark">
        <div class="container-fluid bg-dark">
            <div class=" row pt-5 m-auto justify-content-center">
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <img src="{{asset('img/img1.jpg')}}" alt="" class="card-img-top">
                        <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="post" action="saveEquipmentRequest" enctype="multipart/form-data">
                                @csrf
                                <h5 class="card-title">Equipments License Request</h5>
                                <div class="input-group ">
                                    <div class="input-group-prepend ">
                                        <span class="input-group-text" id="validationTooltipUsernamePrepend">Phone Number</span>
                                    </div>
                                    <input type="number" name="phone" class="form-control" placeholder="Enter You Phone Number" required>

                                </div>
                                <br>
                                <label for="formFileLg" class="form-label ">Upload Your License</label>
                                <input class="form-control " id="formFileLg" type="file" name="file" required/>

                                <br>

                                <h5 class="card-title">Address to receive equipments</h5>

                                <div class="input-group ">
                                    <div class="input-group-prepend ">
                                        <span class="input-group-text" id="validationTooltipUsernamePrepend">Address</span>
                                    </div>
                                    <input type="text" name="address" class="form-control" placeholder="Name - block - street - building" required>

                                </div>

                                <br>


                                <div class="mx-auto" style="width: 200px;">
                                    <button type="submit" class="btn btn-dark">Submit</button>
                                    <button type="button" class="btn btn-dark"><a href="vendorSelection" style="color: white ; text-decoration: none;">Cancel</a></button>
                                </div>


                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection



@extends('layouts/main2')


@section('content')




    <body style="background-color:whitesmoke">
    <section id="gallery" >

            <div class=" row pt-5 m-auto justify-content-center">
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <img src="{{asset('img/talent1.jpg')}}" alt="" class="card-img-top">
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

                            <form method="post" action="saveTalentInfo" enctype="multipart/form-data">
                                @csrf
                                <h5 class="card-title">Talent Information</h5>


                                <label for="formFileLg" class="form-label "><b>Personal Picture</b></label>
                                <input class="form-control " id="formFileLg" type="file" name="pPicture" required/>

                                <br>


                                <div class="input-group ">
                                    <div class="input-group-prepend ">
                                        <span class="input-group-text" id="validationTooltipUsernamePrepend">Phone Number</span>
                                    </div>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter your phone number" required>

                                </div>

                                <br>

                                <label for="formFileLg" class="form-label "><b>Gender:</b></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radio" id="inlineRadio1" value="Male" checked>
                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radio" id="inlineRadio2" value="Female">
                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                </div>

                                <br><br>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Languages</label>
                                    </div>
                                    <select class="form-control" id="inputGroupSelect01" required name="languages">
                                        <option value="english">English</option>
                                        <option value="arabic">Arabic</option>
                                        <option value="both">Both</option>
                                    </select>
                                </div>

                                <br>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect2">Profession</label>
                                    </div>
                                    <select class="form-control" id="inputGroupSelect2" required name="profession">
                                        <option value="Model">Model</option>
                                        <option value="Photographer">Photographer</option>
                                        <option value="Videographer">Videographer</option>
                                        <option value="Makeup Artist">Makeup Artist</option>
                                        <option value="Director">Director</option>
                                    </select>
                                </div>



                                <br>

                                <h6>Work fields (*select at least one)</h6>


                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="sport" name="fields[]">
                                    <label class="form-check-label" for="inlineCheckbox1">Sport</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="weddings" name="fields[]">
                                    <label class="form-check-label" for="inlineCheckbox2">Weddings</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="food" name="fields[]" >
                                    <label class="form-check-label" for="inlineCheckbox3">Food</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="fashion"  name="fields[]">
                                    <label class="form-check-label" for="inlineCheckbox3">Fashion</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="commercial"  name="fields[]">
                                    <label class="form-check-label" for="inlineCheckbox3">Commercial</label>
                                </div>

                                <br>
                                <br>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Experience</label>
                                    </div>
                                    <select class="form-control" id="inputGroupSelect01" required name="experience">
                                        <option value="Expert">Expert</option>
                                        <option value="Intermediate">Intermediate</option>
                                        <option value="Beginner">Beginner</option>
                                    </select>
                                </div>

                                <br>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Daily Rate</span>
                                    </div>
                                    <input type="number" class="form-control" min="0" required name="rate" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">BHD</span>
                                    </div>
                                </div>




                                <label for="formFileLg" class="form-label "><b>Upload your CV</b></label>
                                <input class="form-control " id="formFileLg" type="file" name="talentsCv"  required />

                                <br>

                                <div class="mx-auto" style="width: 200px;">
                                    <button type="submit" class="btn btn-dark">Join</button>
                                    <button type="button" class="btn btn-dark"><a href="/" style="color: white ; text-decoration: none;">Cancel</a></button>
                                </div>


                            </form>

                        </div>
                    </div>
                </div>
            </div>

    </section>
    </body>


@endsection


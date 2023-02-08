@extends('layouts/project',['title'=>'Talent Details'])

@section('content')





    @if(session('error1'))
        <div class="alert alert-danger" role="alert">
            {{session('error1')}}
        </div>
    @endif

    @if(session('error2'))
        <div class="alert alert-danger" role="alert">
            {{session('error2')}}
        </div>
    @endif

    @if(session('error3'))
        <div class="alert alert-danger" role="alert">
            {{session('error3')}}
        </div>
    @endif

    @if(session('hired1'))
        <div class="alert alert-danger" role="alert">
            {{session('hired1')}}
        </div>
    @endif

    @if(session('hired2'))
        <div class="alert alert-danger" role="alert">
            {{session('hired2')}}
        </div>
    @endif

    @if(session('message'))
        <div class="alert alert-danger" role="alert">
            {{session('message')}}
        </div>
@endif

    @if(session('message2'))
        <div class="alert alert-success" role="alert">
            {{session('message2')}}
        </div>
    @endif

    @if(session('message3'))
        <div class="alert alert-danger" role="alert">
            {{session('message3')}}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            Talent Details
        </div>
        <div class="card-body">


            <link href="{{asset('css/talentProfile.css')}}" rel="stylesheet" />
            <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
            <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


            <style>
                body{
                    margin-top:20px;
                    background:#eee;
                }
                @media (min-width: 0) {
                    .g-mr-15 {
                        margin-right: 1.07143rem !important;
                    }
                }
                @media (min-width: 0){
                    .g-mt-3 {
                        margin-top: 0.21429rem !important;
                    }
                }

                .g-height-50 {
                    height: 50px;
                }

                .g-width-50 {
                    width: 50px !important;
                }

                @media (min-width: 0){
                    .g-pa-30 {
                        padding: 2.14286rem !important;
                    }
                }

                .g-bg-secondary {
                    background-color: whitesmoke !important;
                }

                .u-shadow-v18 {
                    box-shadow: 0 5px 10px -6px rgba(0, 0, 0, 0.15);
                }

                .g-color-gray-dark-v4 {
                    color: #777 !important;
                }

                .g-font-size-12 {
                    font-size: 0.85714rem !important;
                }

                .media-comment {
                    margin-top:20px
                }

                .my-custom-scrollbar {
                    position: relative;
                    width: 800px;
                    height: 400px;
                    overflow: auto;
                }
            </style>



        @foreach($talents as $talent)


                <!------ Include the above in your HEAD tag ---------->



                    <div class="row">
                        <div class="col-md-4">

                            <div class="profile-img">
                                <img src="{{asset('storage/talentsPictures/'.$talent['picture'])}}" alt=""/>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-head">
                                <h5>
                                    {{$talent['name']}}
                                </h5>
                                <h6>
                                    {{$talent['profession']}}
                                </h6>
                                <p class="proile-rating">RANKINGS : <span>{{$rating}}/5</span></p>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false" style="color: goldenrod">Reviews</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="hire-tab" data-toggle="tab" href="#hire" role="tab" aria-controls="hire" aria-selected="false" style="color: red"><strong>Hire</strong></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <a href="/crewPage" >
                                <input type="button" class="profile-edit-btn" name="btnAddMore" value="Back"/>
                            </a>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="profile-work">

                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                    <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>  {{$talent['name']}}</p>
                                            </div>
                                    </div>

                                    <div class="row">
                                            <div class="col-md-6">
                                                <label>Gender</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$talent['gender']}}</p>
                                            </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>  {{$talent['email']}}</p>
                                            </div>
                                    </div>


                                    <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$talent['phone']}}</p>
                                            </div>
                                    </div>

                                    <div class="row">
                                            <div class="col-md-6">
                                                <label>Profession</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$talent['profession']}}</p>
                                            </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Working Fields</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                @foreach($fields as $field)
                                                    {{ ucfirst(trans($field)) }} -
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Experience</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$talent['experience']}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Hourly Rate</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$talent['daily_Rate']}} BHD/Day</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>English Language</label>
                                        </div>
                                        <div class="col-md-6">
                                            @if($talent['languages'] == 'both')
                                                <p>English - Arabic</p>
                                            @else
                                                <p>{{$talent['languages']}}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Cv</label><br/>
                                            <p><a href="{{asset('storage/talentsCV/'.$talent['cv'])}}">Talent CV</a></p>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="hire" role="tabpanel" aria-labelledby="hire-tab">


                                    <form action="/sendHireRequest" method="post">
                                        @csrf

                                        <input type="hidden" name="price" value="{{$talent['daily_Rate']}}">
                                        <input type="hidden" name="talent_id" value="{{$talent['id']}}">
                                        <div class="input-group ">
                                            <div class="input-group-prepend ">
                                                <span class="input-group-text" id="validationTooltipUsernamePrepend">Start Date</span>
                                            </div>
                                            <input type="date" name="start_date" class="form-control" placeholder="Enter project title" required>

                                        </div>
                                        <br>

                                        <div class="input-group ">
                                            <div class="input-group-prepend ">
                                                <span class="input-group-text" id="validationTooltipUsernamePrepend">End Date</span>
                                            </div>
                                            <input type="date" name="end_date" class="form-control" placeholder="Enter project title" required>
                                        </div>

                                        <br>



                                        <button class="btn btn-dark btn-lg"  type="submit">Send a request</button>

                                    </form>


                                </div>


                                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">


                                     <!-- start review part -->
                                        <div class="row">
                                            <div class="col-4">
                                                <h3>Write a review</h3>

                                                <br>

                                                <div>

                                                    <strong>Rate the Talent</strong>

                                                    <i class="fa fa-star fa-2x" data-index="0" ></i>
                                                    <i class="fa fa-star fa-2x"   data-index="1" ></i>
                                                    <i class="fa fa-star fa-2x"  data-index="2"  ></i>
                                                    <i class="fa fa-star fa-2x"   data-index="3" ></i>
                                                    <i class="fa fa-star fa-2x" data-index="4"  ></i>
                                                </div>


                                                <br>


                                                <form method="post" action="/talentRating">
                                                    @csrf


                                                    <input type="hidden" id="rating" value="" name="rating">
                                                    <input type="hidden"  value="{{$talent['user_id']}}" name="talent_id">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Comment</span>
                                                        </div>

                                                        <textarea class="form-control" aria-label="With textarea" name="comment" required></textarea>
                                                    </div>

                                                    <br>

                                                    <button type="submit" class="btn btn-dark">Submit</button>

                                                </form>
                                            </div>


                                            <div class="col-8 ">
                                                <!-- start comment -->
                                                <h3>Reviews</h3>
                                                <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
                                                <div class="my-custom-scrollbar my-custom-scrollbar-primary">

                                                        @forelse($comments as $comment)
                                                            <div class="media g-mb-30 media-comment">
                                                                <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                                                                    <div class="g-mb-15">
                                                                        <h5 class="h5 g-color-gray-dark-v1 mb-0">{{$comment['name']}}</h5>
                                                                        <span class="g-color-gray-dark-v4 g-font-size-12">{{$comment['created_at']}}</span>
                                                                    </div>

                                                                    <p>{{$comment['comment']}}</p>

                                                                </div>
                                                            </div>

                                                    @empty
                                                        <h4 style="color: darkgray"  class="text-center font-weight-light">There are no reviews for this talent </h4>
                                                    @endforelse




                                                </div>


                                                <!-- end comment -->
                                            </div>
                                        </div>
                                    <!-- end review part -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>

        @endforeach










    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        var ratedIndex = -1, uID = 0;
        $(document).ready(function () {
            resetStarColors();


            $('.fa-star').on('click', function () {
                ratedIndex = parseInt($(this).data('index'));
                saveRating();
            });



            $('.fa-star').mouseover(function () {
                resetStarColors();
                var currentIndex = parseInt($(this).data('index'));
                setStars(currentIndex);

            });

            $('.fa-star').mouseleave(function () {
                resetStarColors();

                if (ratedIndex != -1)
                    setStars(ratedIndex);
            });
        });


        function saveRating() {
            $("#rating").val(ratedIndex);
        }



        function setStars(max) {
            for (var i=0; i <= max; i++)
                $('.fa-star:eq('+i+')').css('color', 'gold');
        }

        function resetStarColors() {
            $('.fa-star').css('color', 'darkgray');
        }

        var myCustomScrollbar = document.querySelector('.my-custom-scrollbar');
        var ps = new PerfectScrollbar(myCustomScrollbar);

        var scrollbarY = myCustomScrollbar.querySelector('.ps__rail-y');

        myCustomScrollbar.onscroll = function () {
            scrollbarY.style.cssText = `top: ${this.scrollTop}px!important; height: 400px; right: ${-this.scrollLeft}px`;
        }

    </script>
@endsection

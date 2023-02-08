@extends('layouts/project',['title'=>'Payemnt'])

@section('content')


    <div class="card">
        <div class="card-header">
            Payment
        </div>


        <div class="card-body">

            <!-- start-->

            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="card ">
                        <div class="card-header">
                            <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">

                                <h3>Total:        {{$total}}BD  For  {{$days}}  Days</h3>
                            </div> <!-- End -->
                            <!-- Credit card form content -->
                            <div class="tab-content">
                                <!-- credit card info-->
                                <div id="credit-card" class="tab-pane fade show active pt-3">
                                    <form role="form" method="post" action="makeLocationRental" >
                                        @csrf
                                        <input type="hidden" name="price" value="{{$total}}">
                                        <input type="hidden" name="location_id" value="{{$location_id}}">
                                        <input type="hidden" name="start" value="{{$start}}">
                                        <input type="hidden" name="end" value="{{$end}}">
                                        <input type="hidden" name="project_id" value="{{session()->get('projectID')}}">

                                        <div class="form-group"> <label for="username">
                                                <h6>Card Owner</h6>
                                            </label> <input type="text" name="username" placeholder="Card Owner Name" required class="form-control "> </div>
                                        <div class="form-group"> <label for="cardNumber">
                                                <h6>Card number</h6>
                                            </label>
                                            <div class="input-group"> <input type="text" name="cardNumber" placeholder="Valid card number" class="form-control " required>
                                                <div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group"> <label><span class="hidden-xs">
                                                    <h6>Expiration Date</h6>
                                                </span></label>
                                                    <div class="input-group"> <input type="number" placeholder="MM" name="" class="form-control" required> <input type="number" placeholder="YY" name="" class="form-control" required> </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                        <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                                    </label> <input type="text" required class="form-control"> </div>
                                            </div>
                                        </div>
                                        <div class="card-footer"> <button type="submit" class="subscribe btn btn-dark btn-block shadow-sm"> Confirm Payment </button>
                                    </form>

                                </div>
                            </div> <!-- End -->
                        </div>  <!-- Paypal info -->

                        <!-- bank transfer info -->

                        <!-- End -->
                    </div>
                </div>
            </div>
        </div>



        <!-- end -->




    </div>
    </div>






@endsection

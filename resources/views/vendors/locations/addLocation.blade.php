
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


<form action="addLocation" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true" >
        <div class="modal-dialog modal-lg" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('Add New Location')}} </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Place Picture</label>
                            <input class="form-control" type="file" id="formFileMultiple" name="file" required>
                        </div>


                    <div class="form-group">
                        <label >Name </label>
                        <input type="text" class="form-control"   placeholder="Enter a Name" name="name" required>
                    </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="desc" required></textarea>
                        </div>

                        <div class="input-group ">
                            <div class="input-group-prepend ">
                                <span class="input-group-text" id="validationTooltipUsernamePrepend">Address</span>
                            </div>
                            <input type="text" name="address" class="form-control" placeholder="Area - block - street - building" required>

                        </div>



                        <div class="form-group">
                        <label >Price/day </label>
                        <input type="number" class="form-control"   placeholder="Enter the price " name="price">
                    </div>


                    <button type="submit" class="btn btn-dark">Add</button>


                </div>
            </div>
        </div>
    </div>



</form>



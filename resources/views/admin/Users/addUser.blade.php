

<form action="addUser" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true" >
        <div class="modal-dialog modal-lg" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('Add New User')}} </h4>
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

                        <div class="form-group">
                            <label >Name </label>
                            <input type="text" class="form-control"   placeholder="Enter a Name" name="name">
                        </div>

                        <div class="form-group">
                            <label >Email </label>
                            <input type="email" class="form-control"   placeholder="Enter an email" name="email">
                        </div>


                        <div class="form-group">
                            <label >Password </label>
                            <input type="password" class="form-control"   placeholder="Enter a Password" name="password">
                        </div>


                        <button type="submit" class="btn btn-primary">Add</button>


                </div>
            </div>
        </div>
    </div>



</form>



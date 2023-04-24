@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                </div>
                <div class="card-body">
                    <form method="post" action="">
                        @csrf
                        <div class="form-group">
                            <label>Admin name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" >
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <div class="mt-3 form-inline">
                                    <div class="custom-control custom-radio mr-3">
                                        <input type="radio" id="customRadio1" name="gender" class="custom-control-input" value="0" checked>
                                        <label class="custom-control-label" for="customRadio1">Nam</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio2" name="gender" class="custom-control-input" value="1">
                                        <label class="custom-control-label" for="customRadio2">Nữ</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" name="phone" >
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success ">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layout.main')
@section('main_section')
@include('layout.header')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Admin panel/Add User</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="{{Route('dashboard')}}">Dashboard</a></li>

                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- Row -->
        <div class="col-md-12">
            <div class="white-box">
             

            @if(session()->has('success'))
                        <div class="alert alert-success  " role="alert">
                            {{ session()->get('success') }}
                        </div>
                        @endif
                <form class="form-horizontal" action="{{Route('adminAddUser')}}" method="post" id="loginform">
                    @csrf
                    <div class="form-group">
                       
                        <label for="user" class="col-sm-3 control-label">Username</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-user"></i></div>
                                <input type="text" class="form-control" id="exampleInputuname" name="name" placeholder="Username">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email Id</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-email"></i></div>
                                <input type="email" class="form-control" name="email" placeholder="Enter email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-lock"></i></div>
                                <input type="password" class="form-control" name="password" placeholder="Enter password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword" class="col-sm-3 control-label">Confirm Password</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-lock"></i></div>
                                <input type="password" class="form-control" name="confirm_password" placeholder="Re Enter Password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-info waves-effect waves-light m-t-10">Add User</button>
                            <a type="submit" href="{{Route('displayUser')}}" class="btn btn-info waves-effect waves-light m-t-10 m-l-20">Users</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#loginform').validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
            },
            password: {
                required: true,

            },
            confirm_password: {
                required: true,
                equalTo: '[name="password"]',
            },
        },
        messages: {
            name: {
                required: "Please Enter Name",
            },
            email: {

                email: "Please enter valid email id"
            },
            password: {
                required: "Please enter password",
            },
            confirm_password: {
                equalTo: "password is not same",
                required: "Confirm password is required",

            },
        },
    })
</script>
@include('layout.footer')
@endsection
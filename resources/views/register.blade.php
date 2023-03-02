@extends('layout.main')
@section('main_section')

<section id="wrapper" class="login-register">
  <div class="login-box">
    <div class="white-box">
      <form class="form-horizontal form-material" id="loginform" method="post" action="{{ Route('userRegister') }}" >
        <h3 class="box-title m-b-20">Sign In</h3>
        <div class="form-group ">
          <div class="col-xs-12">
            @csrf
            <input type="text" placeholder="Name" id="name" class="form-control" name="name" required autofocus>
            @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
            <!-- @if (session()->has('Success'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session()->get('Success') }} 
            </div>
            @endif -->
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
          <input type="text" placeholder="Email" id="email_address" class="form-control" name="email" required autofocus>
          @if ($errors->has('email'))
          <span class="text-danger">{{ $errors->first('email') }}</span>
          @endif
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
          <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
          @if ($errors->has('password'))
          <span class="text-danger">{{ $errors->first('password') }}</span>
          @endif
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="password"  placeholder="Confirm Password" name="confirm_password">
          </div>
        </div>        
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Sign Up</button>
          </div>
        </div>
        <div class="form-group m-b-0">
          <div class="col-sm-12 text-center">
            <p>Already have an account? <a href="{{Route('login')}}" class="text-primary m-l-5"><b>Sign In</b></a></p>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
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
                    equalTo:'[name="password"]',
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
                    required: "Confirm password is required",
                    //equalTo: "password is not same"
                },
            },
        })
      


    </script>       
    @endsection
  


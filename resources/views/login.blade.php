@extends('layout.main')
@section('main_section')
  <section id="wrapper" class="login-register">
    <div class="login-box">
      <div class="white-box">
        <form class="form-horizontal form-material" id="loginform" action="{{ Route('userLogin') }}" method="post">
          <h3 class="box-title m-b-20">Sign In</h3>
          <div class="form-group ">
            <div class="col-xs-12">
              @csrf
              <input type="text" placeholder="Email" id="email" class="form-control" name="email" required autofocus>
              @if ($errors->has('email'))
              <span class="text-danger">{{ $errors->first('email') }}</span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="col-xs-12">
              <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
              @if ($errors->has('password'))
              <span class="text-danger">{{ $errors->first('password') }}</span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <a href="{{Route('forgotPasswordPage')}}" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i>
                Forgot pwd?</a>
            </div>
          </div>
          <div class="form-group text-center m-t-20">
            <div class="col-xs-12">
              <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
              <div class="social"><a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a> <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a> </div>
            </div>
          </div>
          <div class="form-group m-b-0">
            <div class="col-sm-12 text-center">
              <p>Don't have an account? <a href="{{Route('register')}}" class="text-primary m-l-5"><b>Sign Up</b></a></p>
            </div>
          </div>
        </form>       
      </div>
    </div>
  </section>
    <script>
      $('#loginform').validate({
        rules: {
          username: {
            required: true,
          },
          password: {
            required: true,
          }
        },
        messages: {
          username: {
            required: "Please Enter username"
          },
          password: {
            required: "Please Enter password"
          }
        }
      })
    </script>
  @endsection
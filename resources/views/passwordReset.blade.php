@extends('layout.main')
@section('main_section')
<section id="wrapper" class="login-register">
    <div class="login-box">
        <div class="white-box">
            <form class="form-horizontal form-material" id="loginform" action="{{ route('resetPassword') }}" method="POST">
                <h3 class="box-title m-b-20">Reset Password</h3>
                @csrf
                <input type="hidden" name="token" value="{{ $token }}" id="loginform">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="email"> Email </label><br>
                        <input type="text" class="form-conrtol" name="email" placeholder=" enter your email adress" value="{{ $email ?? old('email') }}">
                        <span class="text-danger">@error('email'){{ "please enter valid mail" }}@enderror</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="passsword"> passsword </label>
                        <input type="text" class="form-conrtol" name="password" placeholder=" enter your passsword" value="">
                        <span class="text-danger">@error('passsword'){{ "please enter valid passsword" }}@enderror</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="passsword"> Confim passsword </label>
                        <input type="text" class="form-conrtol" name="confirm_passsword" placeholder=" enter your confim passsword" value="">
                        <span class="text-danger">@error('confim_passsword'){{ "please enter valid Confim passsword" }}@enderror</span>
                    </div>
                </div>

                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset Password</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                        <div class="social"><a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a> <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a> </div>
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                        <p> <a href="{{Route('login')}}" class="text-primary m-l-5"><b>Login</b></a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
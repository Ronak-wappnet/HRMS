@extends('layout.main')
@section('main_section')
<section id="wrapper" class="login-register">
    <div class="login-box">
        <div class="white-box">
            @if (session()->has('fail'))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session()->get('fail') }}
            </div>
            @endif
            <form form class="form-horizontal form-material" id="loginform" action="{{ route('resetPasswordFormAction') }}" method="POST">
                <div class="form-group">
                    <label>Reset Password</label>
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}" id="loginform">
                </div>
                <div class="form-group">
                    <label for="InputEmail1">Email address</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="ti-email"></i></div>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder=" Enter email" name="email">
                        <span class="text-danger">@error('email'){{ "please enter valid mail" }}@enderror</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="ti-lock"></i></div>
                        <input type="password" class="form-control" id="exampleInputpwd1" placeholder=" Enter password" name="password">
                        <span class="text-danger">@error('password'){{ "please enter valid passsword" }}@enderror</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputpwd2">Confirm Password</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="ti-lock"></i></div>
                        <input type="password" class="form-control" id="exampleInputpwd2" placeholder=" confirm password" name="confirm_passsword">
                        <span class="text-danger">@error('confirm_passsword'){{ "please enter valid Confim passsword" }}@enderror</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Reset</button>
                <a class="btn btn-inverse waves-effect waves-light" href="{{Route('login')}}">login</a>
            </form>
        </div>
    </div>
</section>
@endsection
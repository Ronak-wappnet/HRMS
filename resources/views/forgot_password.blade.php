@extends('layout.main')
@section('main_section')
<section id="wrapper" class="login-register">
    <div class="login-box">
        <div class="white-box">
            <div class="card-body px-5">
                @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session()->get('error') }}
                </div>
                @endif
                @if (session()->has('success'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session()->get('success') }}
                </div>
                @endif
                <form class="form-horizontal" id="forgotPassword"action="{{Route('userForgotPassword')}}" method="post">
                    @csrf
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recover Password</h3>
                            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="email" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                            <a class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" href="{{Route('login')}}">login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
      $('#forgotPassword').validate({
        rules: {
          email: {
            required: true|email,
          }          
        },
        messages: {
          email: {
            required: "Please Enter email Id",
            email:"Enetr valid Email id"
          }
        }
      })
    </script>
@endsection
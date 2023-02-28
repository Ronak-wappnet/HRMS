@extends('layout.main')
@section('main_section')
<section id="wrapper" class="login-register">
    <div class="login-box">
        <div class="white-box">
            <div class="card-header h4 text-white bg-primary">Password Reset</div>
            <div class="card-body px-5">

                <div class="white-box">
                    @if (session('error'))
                    <div class="alert alert-error alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session('error') }}
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session('success') }}
                    </div>
                    @endif
                    <p class="card-text py-2">
                        Enter your email address,
                        Reset password link will be sent to your Email.
                    </p>
                    <form method="POST" action="{{Route('userForgotPassword')}}">
                        @csrf
                        <input type="email" id="email" name="email" placeholder="Enter registerd email" class="form-control my-3" />
                        <br>
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
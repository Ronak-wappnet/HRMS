@extends('layout.main')
@section('main_section')
@include('layout.header')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">User Profile</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="{{Route('dashboard')}}">Dashboard</a></li>

                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- Row -->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @elseif (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                    <form method="POST" action="{{Route('userProfileUpdate')}}">
                        <label>User Name</label>
                        <div class="form-group pass_show">
                            @csrf
                            <input type="text" id="email" name="username" value="{{Auth::user()->name}}" class="form-control my-3" />
                            @error('username')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <label>Email Id</label>
                        <div class="form-group pass_show">
                        <input type="email" id="email" name="email" value="{{Auth::user()->email}}" class="form-control my-3" />
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">
                Update Data
            </button>
                        
                    </form>
                </div>
            </div>
        </div>
        

        @include('layout.footer')
        @endsection


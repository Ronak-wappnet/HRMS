@extends('layout.main')
@section('main_section')
@include('layout.header')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Change Password</h4>
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
                    <form id="changePassForm" action="{{ Route('changePassword') }}" method="post">
                        <label>Current Password</label>
                        <div class="form-group pass_show">
                            @csrf
                            <input type="password" class="form-control" placeholder="Current Password" name="old_password">
                            @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <label>New Password</label>
                        <div class="form-group pass_show">
                            <input type="password" class="form-control" placeholder="New Password" name="new_password">
                            @error('new_password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <label>Confirm Password</label>
                        <div class="form-group pass_show">
                            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password">
                        </div>
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('layout.footer')
        @endsection
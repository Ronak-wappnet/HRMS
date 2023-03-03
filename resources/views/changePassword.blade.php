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

        <div class="col-md-12">
            <div class="white-box">
                <div class="white-box">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @elseif (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                    <form method="POST" action="{{Route('changePassword')}}" class="form-horizontal" id="changePassForm">
                        @csrf
                        <div class="form-group">
                            <label for="currentPassword" class="col-sm-3 control-label">Current Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" placeholder="Current Password" name="old_password">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="new password" class="col-sm-3 control-label">New Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" placeholder="New Password" name="new_password">
                                @error('new_password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="confirmpassword" class="col-sm-3 control-label">Confirm Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password">
                            </div>
                        </div>

                        <div class="form-group m-b-0">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-info waves-effect waves-light m-t-10">Update</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        @include('layout.footer')
        @endsection
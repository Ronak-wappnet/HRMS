@extends('layout.main')
@section('main_section')
@include('layout.header')
<!-- Page Content -->

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Users</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="{{Route('dashboard')}}">Dashboard</a></li>

                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- Row -->
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Email id</th>
                    <!-- <th>Password</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td >{{$user->id}}</td>
                    <td >{{$user->name}}</td>
                    <td >{{$user->email}}</td>
                   <td><a href="{{Route('editUserPage',['user' => $user]) }}">Edit</a></td>
                </tr> 
                @endforeach
            </tbody>

        </table>

        @include('layout.footer')
        @endsection
@extends('layout.main')
@section('main_section')
@include('layout.header')
<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row bg-title">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Dashboard</h4>
      </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        
        <ol class="breadcrumb">
          <li><a href="{{Route('dashboard')}}">Dashboard</a></li>         
        </ol>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- Row -->
    @include('layout.footer')
    @endsection
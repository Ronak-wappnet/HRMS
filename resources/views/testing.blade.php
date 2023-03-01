@extends('layout.main')
@section('main_section')
@include('layout.header')
    <title>Data table </title>


    @if(session()->has('success'))

    <div class="alert alert-success">
        {{session()->get('success')}}
    </div>
    @endif
    <div id="page-wrapper">
        <div class="container-fluid">
          <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
              <h4 class="page-title">User Profile Page</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
              <a href="https://themeforest.net/item/elite-admin-responsive-dashboard-web-app-kit-/16750820" target="_blank" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Buy Now</a>
              <ol class="breadcrumb">
                <li><a href="#">usertable</a></li>
                <li class="active">User details Page</li>
              </ol>
            </div>
            <!-- /.col-lg-12 -->
          </div> 
            <table class="table table-bordered user_datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(function($){
        
    var table = $('.user_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('test') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false},]
    });
    })
</script>
@include('layout.footer')
@endsection
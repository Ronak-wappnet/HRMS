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
        <div class="row">
        
        <div class="col-sm-12">
         @can('editUser') <div>
                            <a class="btn btn-success" href="{{ Route('add') }}"> Add user</a>
                        </div>
                        @endcan
        </div>
            <div class="col-sm-12">
                <div class="white-box">

                    @if (session()->has('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('status') }}
                    </div>
                    @endif
                    @if (session()->has('Success'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('Success') }}
                    </div>
                    @endif                    
                    <div class="table-responsive">
                       
                        <table class="table table-bordered user_datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    @can('editUser')<th width="100px">Action</th>@endcan
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  $(document).ready(function() {
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();           
            var id = $(this).attr("data-id");
            var url = $(this).attr("data-url");
            Swal.fire({
                title: 'Are you sure?'
                , text: "Do you want to delete Holiday!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) { 
                    window.location.href= url,
                    Swal.fire(
                        'Deleted!'
                        , 'Holiday has been deleted.'
                        , 'success'
                    )
                }
            })
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    jQuery(function($) {

        var table = $('.user_datatable').DataTable({
            processing: true
            , serverSide: true
            , ajax: "{{ route('indexAction') }}"
            , columns: [{
                    data: 'id'
                    , name: 'id'
                }
                , {
                    data: 'name'
                    , name: 'name'
                }
                , {
                    data: 'email'
                    , name: 'email'
                }
                ,@can('editUser'){
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                    , searchable: false
                }
                ,@endcan
            ]
        });
    })     
</script>

@include('layout.footer')
@endsection

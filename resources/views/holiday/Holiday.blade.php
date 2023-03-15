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
        <
        <div class="pull-right" >
                <a class="btn btn-success" href="{{ route('createHoliday') }}"> Create holiday</a>
            <br>
            <br>
            </div> 
           
             <br>      
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

                        <table class="table table-bordered" id="datatable-crud">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>title</th>
                                    <th>start_date</th>
                                    <th>end_date</th>
                                    <th>optional</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#datatable-crud').DataTable({
            processing: true
            , serverSide: true
            , ajax: "{{ route('holiday-indexAction') }}"
            , columns: [{
                    data: 'id'
                    , name: 'id'
                }
                , {
                    data: 'title'
                    , name: 'title'
                }
                , {
                    data: 'start_date'
                    , name: 'start_date'
                }
                , {
                    data: 'end_date'
                    , name: 'end_date'
                }
                , {
                    data: 'optional'
                    , name: 'optional'
                }
                , {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                }
            , ]
        });
    });

</script>

@include('layout.footer')
@endsection

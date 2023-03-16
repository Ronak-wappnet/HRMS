@extends('layout.main')
@section('main_section')
@include('layout.header')
<!-- Page Content -->

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Holidays</h4>
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
                        @can('editUser') <div class="pull-left mb-2">
                            <a class="btn btn-success" href="#"> Add Holiday</a>
                        </div>
                        @endcan
                        <table class="table table-bordered user_datatable">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>title</th>
                                    <th>start_date</th>
                                    <th>end_date</th>
                                    <th>optional</th>
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
<script type="text/javascript">
    jQuery(function($) {

        var table = $('.user_datatable').DataTable({
            processing: true
            , serverSide: true
            , ajax: "{{ route('listHoliday') }}"
            , columns: [{
                    data: 'id'
                    , 
                    , name = 'id'
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
                }, {
                    data: 'optional'
                    , name: 'optional'
                }
                , @can('editUser') {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                }
                , @endcan

            ]
        });
    })

</script>
@include('layout.footer')
@endsection

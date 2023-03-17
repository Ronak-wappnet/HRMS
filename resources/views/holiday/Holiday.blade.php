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

            @can('editUser')
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('createHoliday') }}"> Create holiday</a>
                <br>
                <br>
            </div>

            @endcan

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
                                    <th>id</th>
                                    <th>title</th>
                                    <th>day</th>
                                    <th>date</th>
                                    <th>is_optional</th>
                                    @can('editUser')
                                    <th>Action</th>
                                    @endcan
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

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
                },

                {
                    data: 'title'
                    , name: 'title'
                }
                , {
                    data: 'day'
                    , name: 'day'
                }
                , {
                    data: 'start_date'
                    , name: 'start_date'
                }
                , {
                    data: 'optional'
                    , name: 'optional'
                }
                , @can('editUser') {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                    , searchable: true
                }
                , @endcan
            ]
        });
    });

</script>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();           

            Swal.fire({
                title: 'Are you sure?'
                , text: "You won't be able to revert this!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) { 
                    $("#confirm_delete").submit(),
                    Swal.fire(
                        'Deleted!'
                        , 'Your file has been deleted.'
                        , 'success'
                    )
                }
            })
        });
    });

</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@include('layout.footer')
@endsection

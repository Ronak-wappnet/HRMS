@extends('layout.main')
@section('main_section')
@include('layout.header')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Add Holiday</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{Route('dashboard')}}">Dashboard</a></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- Row -->
        @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <form data-toggle="validator" method="post" action="{{ Route('createHolidayAction') }}" id="holiday">
                        @csrf
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <input type="text" id="holiday" name="title" class="form-control" placeholder="Holiday name">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="example">
                                    <label class="control-label">Date</label>
                                    <div class="input-daterange input-group" id="date-range">
                                        <input type="text" placeholder="Start Date" class="form-control" id="start-date" name="start_date" />
                                        <span class="input-group-addon bg-info b-0 text-white">to</span>
                                        <input type="text" placeholder="End Date" class="form-control" id="end-date"name="end_date" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="control-label">Year</label>
                                    <select id="ddlYears" class="form-control " name="year"></select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div>
                                        <input id="checkbox1" name="optional" type="checkbox">
                                        <label for="checkbox1">is optional </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                        <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                    </form>
                </div>
            </div>
            <script>
                $('#holiday').validate({
                        rules: {
                            title: {
                                required: true
                            , }
                            , start_date: {
                                required: true
                            , }
                            , end_date: {
                                required: true
                            , }
                            , year: {
                                required: true
                            , }
                        , }
                        , messages: {
                            title: {
                                required: "Please enter Holiday title"
                            , }
                            , start_date: {
                                required: "please enter holiday start date"
                            , }
                            , end_date: {
                                required: "please enter holiday End date"
                            , }
                            , year: {
                                required: "please enter year of holiday"
                            , }
                        , }
                    , })
                     <script >
                    $(document).ready(function() {
                        $('#holida').submit(function(e) {
                            e.preventDefault();
                            var start_date = new Date($('#start-date').val());
                            var end_date = new Date($('#end-date').val());

                            if (end_date < start_date) {
                                alert('End date must be greater than or equal to start date!');
                            } else {
                                // Submit the form
                                $(this).unbind('submit').submit();
                            }
                        });
                    });

            </script>

            </script>
            <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
            <!-- Bootstrap Core JavaScript -->
            <script src="bootstrap/dist/js/bootstrap.min.js"></script>
            <!-- Menu Plugin JavaScript -->
            <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

            <!--slimscroll JavaScript -->
            <script src="js/jquery.slimscroll.js"></script>
            <!--Wave Effects -->
            <script src="js/waves.js"></script>
            <!-- Custom Theme JavaScript -->
            <script src="js/custom.min.js"></script>
            <!-- Plugin JavaScript -->
            <script src="../plugins/bower_components/moment/moment.js"></script>
            <!-- Clock Plugin JavaScript -->
            <script src="../plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.js"></script>
            <!-- Color Picker Plugin JavaScript -->
            <script src="../plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
            <script src="../plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
            <script src="../plugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
            <!-- Date Picker Plugin JavaScript -->
            <script src="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
            <!-- Date range Plugin JavaScript -->
            <script src="../plugins/bower_components/timepicker/bootstrap-timepicker.min.js"></script>
            <script src="../plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
            <script>
                // Date Picker
                jQuery('.mydatepicker, #datepicker').datepicker();
                jQuery('#datepicker-autoclose').datepicker({
                    autoclose: true
                    , todayHighlight: true
                });

                jQuery('#date-range').datepicker({
                    toggleActive: true
                });
                jQuery('#datepicker-inline').datepicker({

                    todayHighlight: true
                });

                // Daterange picker

                $('.input-daterange-datepicker').daterangepicker({
                    buttonClasses: ['btn', 'btn-sm']
                    , applyClass: 'btn-danger'
                    , cancelClass: 'btn-inverse'
                });
                $('.input-daterange-timepicker').daterangepicker({
                    timePicker: true
                    , format: 'MM/DD/YYYY h:mm A'
                    , timePickerIncrement: 30
                    , timePicker12Hour: true
                    , timePickerSeconds: false
                    , buttonClasses: ['btn', 'btn-sm']
                    , applyClass: 'btn-danger'
                    , cancelClass: 'btn-inverse'
                });
                $('.input-limit-datepicker').daterangepicker({
                    format: 'MM/DD/YYYY'
                    , minDate: '06/01/2015'
                    , maxDate: '06/30/2015'
                    , buttonClasses: ['btn', 'btn-sm']
                    , applyClass: 'btn-danger'
                    , cancelClass: 'btn-inverse'
                    , dateLimit: {
                        days: 6
                    }
                });

            </script>
            <script type="text/javascript">
                window.onload = function() {
                    //Reference the DropDownList.
                    var ddlYears = document.getElementById("ddlYears");

                    //Determine the Current Year.
                    var currentYear = (new Date()).getFullYear();

                    //Loop and add the Year values to DropDownList.
                    for (var i = currentYear; i <= 2100; i++) {
                        var option = document.createElement("OPTION");
                        option.innerHTML = i;
                        option.value = i;
                        ddlYears.appendChild(option);
                    }
                };

            </script>

            @include('layout.footer')
            @endsection

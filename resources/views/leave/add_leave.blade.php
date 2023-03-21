@extends('layout.main')
@section('main_section')
@include('layout.header')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Add Leave</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{Route('dashboard')}}">Dashboard</a></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- Row -->
        @if (session()->has('Success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('Success') }}
        </div>
        @endif
        <div class="row">
            <div class="col-sm-7">
                <div class="white-box">
                    <form data-toggle="validator" method="post" id="leave" action="{{ Route("leave-add-action") }}">
                        @csrf
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="leave_subject">Subject:</label>
                                    <input type="text" name="subject" id="leave_subject" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group"><br>
                                    <label for="leave_start_date">Select leave days and leave types on start and end dates</label>
                                    <div class="input-daterange input-group" id="date-range">
                                        <input type="date" name="start_date" id="start_date" class="form-control">
                                        <span class="input-group-addon bg-info b-0 text-white">to</span>
                                        <input type="date" name="end_date" id="end_date" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="start_date_leave_type" id="is_full_day" class="form-control">
                                        <option value="Half Day">Half Day</option>
                                        <option value="Full Day">Full Day</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="end_date_leave_type" id="is_full_day" class="form-control">
                                        <option value="Half Day">Half Day</option>
                                        <option value="Full Day">Full Day</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <label for="leave_balance">Leavse Balance:</label>
                                <br>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6"><br>
                                <label for="leave_reason">Leave Reason</label>
                                <select name="reason" id="is_full_day" class="form-control">
                                    <option value="Sick Leave">Sick Day</option>
                                    <option value="Urgent Leave">Urgent Day</option>
                                    <option value="Personal Leave">Personal Day</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12"><br>
                                <label for="work_reliever">Reliever Work details:</label>
                                <input type="text" name="reliver_work" id="work_reliever" class="form-control" value="{{ old('work_reliever') }}">
                                <br>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                            <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                $('#leave').validate({
                    rules: {
                        subject: {
                            required: true
                        , }
                        , description: {
                            required: true
                        , }
                        , start_date: {
                            required: true
                        , }
                        , end_date: {
                            required: true
                        , }
                        , reason: {
                            required: true
                        , }
                        , reliver_work: {
                            required: true
                        , }
                        }
                        , messages: {
                            subject: {
                                required: "Please enter Leave Subject"
                            , }
                            , description: {
                                required: "please enter Leave description"
                            , }

                            , start_date: {
                                required: "please enter Leave start_date"
                            , }
                            , end_date: {
                                required: "please enter Leave end_date"
                            , }
                            , reason: {
                                required: "please enter Leave Reason"
                            , }
                            , reliver_work: {
                                required: "Please enter Leave reliver_work"
                            , }
                        , }
                   
                 })

            </script>


            @include('layout.footer')
            @endsection

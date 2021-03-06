@extends('layouts/default')
{{-- Page title --}}
@section('title')
    Edit Holiday
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/select2/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/select2/css/select2-bootstrap.css')}}">
    <link href="{{asset('assets/vendors/airdatepicker/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/vendors/toastr/css/toastr.min.css')}}" rel="stylesheet"/>
    <!--end of page level css-->
@stop
@section('content')

<section class="content-header">
    <h1>Edit Holiday</h1>
    <ol class="breadcrumb">
        <li>
            <a href="index ">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="#"> System</a>
        </li>
        <li class="active">
            Edit Holiday
        </li>
    </ol>
</section>
<section class="content">
    <form id="holiday_form" method='POST' action='{!!url("hase_working_holiday")!!}/{!!$hase_working_holiday->holiday_id!!}/update' class="form-horizontal">
        <input type='hidden' name='_token' value='{{Session::token()}}'>
        <input type="hidden" name="requestUrl" id="requestUrl" value="{!!url(Request::segment(1))!!}">
        <div class="row">
            <div class="col-md-12">
                <button type="submit" name="submitbutton" value="Save" class='btn btn-primary btn-inline'>Save</button>
                <button type="submit" name="submitbutton" value="SaveClose" class= 'btn btn-primary btn-inline'>Save &amp; Close</button>
                <a href="{!!url("hase_working_holiday")!!}" class='btn btn-primary btn-inline'>
                    <i class="fa fa-angle-double-left"></i>
                </a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="user-add" data-size="18" data-c="#fff" data-hc="#fff"
                               data-loop="true"></i> Edit Holiday
                        </h3>
                        <span class="pull-right">
                            <i class="fa fa-fw fa-chevron-up clickable"></i>
                        </span>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="holiday_name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-5">
                                <input id="holiday_name" name="holiday_name" type="text" value="{!!$hase_working_holiday->holiday_name!!}" class="form-control required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="holiday_country_id" class="col-sm-2 control-label">Country</label>
                            <div class="col-sm-5">
                                <select name="holiday_country_id" id="holiday_country_id" class="select21 form-control">
                                    <option></option>
                                    @foreach($hase_countries as $hase_country)
                                        @if($hase_country['country_id'] == $hase_working_holiday->country_id)
                                            <option value="{{$hase_country['country_id']}}" selected="selected">{{$hase_country['country_name']}}</option>
                                        @else
                                            <option value="{{$hase_country['country_id']}}">{{$hase_country['country_name']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="holiday_state_id" class="col-sm-2 control-label">State</label>
                            <div class="col-sm-5">
                                <select name="holiday_state_id" id="holiday_state_id" class="select21 form-control">
                                    <option></option>
                                    @foreach($hase_states as $hase_state)
                                        @if($hase_state['state_id'] == $hase_working_holiday->state_id)
                                            <option value="{{$hase_state['state_id']}}" selected>{{$hase_state['state_name']}}</option>
                                        @else
                                            <option value="{{$hase_state['state_id']}}">{{$hase_state['state_name']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="holiday_date" class="col-sm-2 control-label">Date</label>
                            <div class="input-group col-sm-4" style="padding-left: 15px;">
                                <input id="holiday_date" name="holiday_date" type="text" value="<?php if($hase_working_holiday->holiday_date != 0) { echo substr_replace(substr_replace($hase_working_holiday->holiday_date, '-', 4, 0), '-', 7, 0); } else { echo '';}?>" class="form-control pull-left" data-language='en' /> 
                                <div class="input-group-addon">
                                    <i class="fa fa-fw fa-calendar"></i>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection

{{-- page level scripts --}}
@section('footer_scripts')
<!-- begining of page level js -->
<script type="text/javascript" src="{{asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('assets/vendors/toastr/js/toastr.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/select2/js/select2.js')}}"></script>
<script src="{{asset('assets/vendors/airdatepicker/js/datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/airdatepicker/js/datepicker.en.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('assets/js/custom_js/HaseHolidayEdit.js')}}"></script>
<script type="text/javascript">
    @if(Session::has('type'))
       toastr.options = {
    "closeButton": true,
    "positionClass": "toast-top-right",
    "showDuration": "1000",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "swing",
    "showMethod": "show"
    };
    var $toast = toastr["{{ Session::pull('type') }}"]("", "{{ Session::pull('msg') }}");
       @endif
</script>
<!-- end of page level js -->
@stop
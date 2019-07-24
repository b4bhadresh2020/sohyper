@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Edit Trade Limits
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/select2/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/select2/css/select2-bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}">   
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datedropper/datedropper.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/timedropper/css/timedropper.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/bootstrap-switch/css/bootstrap-switch.css')}}"/> 
    <link href="{{asset('assets/vendors/airdatepicker/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">
    <!--end of page level css-->
@stop
@section('content')
<section class="content-header">
    <h1>Edit Trade Limits</h1>
    <ol class="breadcrumb">
        <li>
            <a href="index ">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        
        <li class="active">
            Trade Limits
        </li>
    </ol>
</section>
<section class="content">
    <div class="preloader" style="background: none !important; ">
        <div class="loader_img">
            <img src="{{asset('assets/img/loader.gif')}}" alt="loading..." height="64" width="64">
        </div>
    </div>
    <form id="assetDealForm"  action = '{!! url("trade_limits")!!}/{!!$trade_limits->
        limits_id!!}/update' method = 'POST' class="form-horizontal" role="form" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <button type="submit" name="submitBtn" value="Save" class='btn btn-primary btn-inline'>Save</button>
                <button type="submit" name="submitBtn" value="SaveClose" class = 'btn btn-primary btn-inline'>Save  &amp; close</button>
                <a href="{!!url("trade_limits")!!}" class='btn btn-primary btn-inline'>
                    <i class="fa fa-fw fa-arrow-left"></i>
                </a>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="fa fa-fw fa-crosshairs"></i> Edit Trade Limits Detail
                        </h3>
                    </div>
                    <div class="panel-body">
                        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                        <input type="hidden" name="requestUrl" id="requestUrl" value="{!!url(Request::segment(1))!!}">

                        <input type="hidden"  id="h_city_id" value="{{$trade_limits->city_id}}">
                        <input type="hidden"  id="h_location_id" value="{{$trade_limits->location_id}}">
                            
                        <input type = 'hidden' id ='h_group_id' value='{{$trade_limits->group_id}}'>
                        <input type = 'hidden' id ='h_staff_id' value='{{$trade_limits->staff_id}}'>
                        <input type = 'hidden' id ='h_merchant_account_id' value='{{$trade_limits->merchant_account_id}}'>

                        <input type="hidden"  id="h_customer_id" value="{{$trade_limits->customer_id}}">
                        <input type="hidden"  id="h_customer_account_id" value="{{$trade_limits->customer_account_id}}">
                        <input type="hidden"  id="h_asset_id" value="{{$trade_limits->asset_id}}">

                        
                        <?php if(Session('merchantId') == 0): ?>
                        <div class="form-group">
                            <label for="merchant_id" class="col-sm-3 control-label">Merchant Name</label>
                            <div class="col-sm-4">
                                <select name="merchant_id" id="merchant_id" class="form-control select21" style="width:100%">
                                    <option></option>
                                    @foreach($merchants as $merchant)
                                        @if($trade_limits->merchant_id == $merchant->merchant_id)
                                            <option value="{{$merchant->merchant_id}}" selected="">{{$merchant->merchant_name}}</option>
                                        @else
                                            <option value="{{$merchant->merchant_id}}">{{$merchant->merchant_name}}</option>
                                        @endif    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="city_id" class="col-sm-3 control-label">City Name</label>
                            <div class="col-sm-4">
                                <select name="city_id" id="city_id" class="form-control select21" style="width:100%">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="location_id" class="col-sm-3 control-label">Location Name</label>
                            <div class="col-sm-4">
                                <select name="location_id" id="location_id" class="form-control select21" style="width:100%">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="group_id" class="col-sm-3 control-label">Group Name</label>
                            <div class="col-sm-4">
                                <select name="group_id" id="group_id" class="form-control select21" style="width:100%">
                                    <option></option>  
                                </select>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="staff_id" class="col-sm-3 control-label">Staff Name</label>
                            <div class="col-sm-4">
                                <select name="staff_id" id="staff_id" class="form-control select21" style="width:100%">
                                    <option></option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="merchant_account_id" class="col-sm-3 control-label">Staff Account Name</label>
                            <div class="col-sm-4">
                                <select name="merchant_account_id" id="merchant_account_id" class="form-control select21" style="width:100%">
                                    <option></option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="customer_id" class="col-sm-3 control-label">Customer Name</label>
                            <div class="col-sm-4">
                                <select name="customer_id" id="customer_id" class="form-control select21" style="width:100%">
                                    <option></option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="customer_account_id" class="col-sm-3 control-label">Customer Account Name</label>
                            <div class="col-sm-4">
                                <select name="customer_account_id" id="customer_account_id" class="form-control select21" style="width:100%">
                                    <option></option>
                                    
                                </select>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="asset_id" class="col-sm-3 control-label">Asset</label>
                            <div class="col-sm-4">
                                <select name="asset_id" id="asset_id" class="form-control select21" style="width:100%">
                                    <option></option>
                                    @foreach($assets as $asset)
                                        @if($trade_limits->asset_id == $asset->asset_id)
                                            <option value="{{$asset->asset_id}}" selected="">{{$asset->asset_code}}</option>
                                        @else
                                            <option value="{{$asset->asset_id}}">{{$asset->asset_code}}</option>
                                        @endif    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label for="timezone" class="col-sm-3 control-label">Timezone</label>
                            <div class="col-sm-4">
                                <select name="timezone" id="timezone" class="form-control select21" style="width:100%">
                                    <option></option>
                                    {{--@foreach($timezones as $timezone)
                                        @if($trade_limits->timezone == $timezone->timezone_id)
                                            <option value="{{$timezone->timezone_id}}" selected="">{{$timezone->timezone_name}}</option>
                                        @else
                                            <option value="{{$timezone->timezone_id}}">{{$timezone->timezone_name}}</option>   
                                        @endif     
                                    @endforeach--}}
                                </select>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label for="day_start" class="col-sm-3 control-label">Day Start</label>
                            <div class="col-sm-4">
                                <input id="day_start" name = "day_start" type="number" class="form-control" value="{{$trade_limits->day_start}}"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="day_end" class="col-sm-3 control-label">Day End</label>
                            <div class="col-sm-4">
                                <input id="day_end" name = "day_end" type="number" class="form-control" value="{{$trade_limits->day_end}}"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="time_start" class="col-sm-3 control-label">Time Start</label>
                            <div class="input-group col-sm-4" style="padding-left: 15px;padding-right: 15px;">
                                @if(isset($trade_limits->time_start))
                                    <?php
                                        $entryMinutes = $trade_limits->time_start/60;
                                        $entryHour = sprintf("%02d", floor($entryMinutes/60));
                                        $entryMinute = sprintf("%02d", ($entryMinutes % 60));
                                        $entryTime = $entryHour.':'.$entryMinute;
                                    ?>
                                @endif
                                <input id="time_start" name="time_start" type="text" value="<?php echo isset($entryTime)? $entryTime:date('H:m')?>" class="form-control required">
                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="time_end" class="col-sm-3 control-label">Time End</label>
                            <div class="input-group col-sm-4" style="padding-left: 15px;padding-right: 15px;">
                                @if(isset($trade_limits->time_end))
                                    <?php
                                        $entryMinutes = $trade_limits->time_end/60;
                                        $entryHour = sprintf("%02d", floor($entryMinutes/60));
                                        $entryMinute = sprintf("%02d", ($entryMinutes % 60));
                                        $entryTime = $entryHour.':'.$entryMinute;
                                    ?>
                                @endif
                                <input id="time_end" name="time_end" type="text" value="<?php echo isset($entryTime)? $entryTime:date('H:m')?>" class="form-control required">
                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price_pct_offset" class="col-sm-3 control-label">Price Offset</label>
                            <div class="col-sm-4">
                                <input id="price_pct_offset" name = "price_pct_offset" type="number" class="form-control" value="{{$trade_limits->price_pct_offset}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="quantity_maximum" class="col-sm-3 control-label">Max Quantity</label>
                            <div class="col-sm-4">
                                <input id="quantity_maximum" name = "quantity_maximum" type="number" class="form-control" value="{{$trade_limits->quantity_maximum}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="priority" class="col-sm-3 control-label">Priority</label>
                            <div class="col-sm-4">
                                <input id="priority" name = "priority" type="number" class="form-control" value="{{$trade_limits->priority}}">
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label for="status" class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-4">
                                <input name="status" type="checkbox" id="status" data-on-text="On" data-on-color="success" data-off-color="danger" data-off-text="Off" checked="true" />
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label for="Status" class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-4">
                                <div class="make-switch" data-on="danger" data-off="default">
                                    @if($trade_limits->status)
                                        <input value="{!!$trade_limits->
                                        status!!}" id="status" name="status" type="checkbox" checked="true" />
                                    @else
                                        <input value="{!!$trade_limits->
                                        status!!}" id="status" name="status" type="checkbox" />
                                    @endif
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
<script type="text/javascript" src="{{asset('assets/vendors/moment/js/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/select2/js/select2.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}" ></script>
<script src="{{asset('assets/vendors/airdatepicker/js/datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/airdatepicker/js/datepicker.en.js')}}" type="text/javascript"></script>
<script  type="text/javascript" src="{{asset('assets/vendors/datedropper/datedropper.js')}}" ></script>
<script  type="text/javascript" src="{{asset('assets/vendors/timedropper/js/timedropper.js')}}" ></script>
<script type="text/javascript" src="{{asset('assets/vendors/select2/js/select2.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/bootstrap-switch/js/bootstrap-switch.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom_js/TradeLimitsEdit.js')}}"></script>
@stop
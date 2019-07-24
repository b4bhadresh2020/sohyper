@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Create Trade Risk
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
    <link href="{{asset('assets/vendors/airdatepicker/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">
    <!--end of page level css-->
@stop
@section('content')
<section class="content-header">
    <h1>Create New Trade Risk</h1>
    <ol class="breadcrumb">
        <li>
            <a href="index ">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        
        <li class="active">
            Trade Risk
        </li>
    </ol>
</section>
<section class="content">
    <form id="assetDealForm"  action = '{!!url("trade_risk")!!}' method = 'POST' class="form-horizontal" role="form" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <button type="submit" name="submitBtn" value="Save" class='btn btn-primary btn-inline'>Save</button>
                <button type="submit" name="submitBtn" value="SaveClose" class = 'btn btn-primary btn-inline'>Save  &amp; close</button>
                <a href="{!!url("trade_risk")!!}" class='btn btn-primary btn-inline'>
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
                            <i class="fa fa-fw fa-crosshairs"></i> Add Trade Risk Detail
                        </h3>
                    </div>
                    <div class="panel-body">
                        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                        <input type="hidden" name="requestUrl" id="requestUrl" value="{!!url(Request::segment(1))!!}">
                        <?php if(Session('merchantId') == 0): ?>
                        <div class="form-group">
                            <label for="merchant_id" class="col-sm-3 control-label">Merchant Name</label>
                            <div class="col-sm-4">
                                <select name="merchant_id" id="merchant_id" class="form-control select21" style="width:100%">
                                    <option></option>
                                    @foreach($merchants as $merchant)
                                       <option value="{{$merchant->merchant_id}}">{{$merchant->merchant_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="location_id" class="col-sm-3 control-label">Location Name</label>
                            <div class="col-sm-4">
                                <select name="location_id" id="location_id" class="form-control select21" style="width:100%">
                                    <option></option>
                                    @foreach($location_cities as $city)
                                        <option value="{{$city->city_id}}">{{$city->city_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="group_id" class="col-sm-3 control-label">Group Name</label>
                            <div class="col-sm-4">
                                <select name="group_id" id="group_id" class="form-control select21" style="width:100%">
                                    <option></option>
                                    @foreach($staff_groups as $group)
                                       <option value="{{$group->staff_group_id}}">{{$group->staff_group_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="staff_id" class="col-sm-3 control-label">Staff Name</label>
                            <div class="col-sm-4">
                                <select name="staff_id" id="staff_id" class="form-control select21" style="width:100%">
                                    <option></option>
                                    @foreach($staffs as $staff)
                                       <option value="{{$staff->staff_id}}">{{$staff->staff_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="staff_account_id" class="col-sm-3 control-label">Staff Account Name</label>
                            <div class="col-sm-4">
                                <select name="staff_account_id" id="staff_account_id" class="form-control select21" style="width:100%">
                                    <option></option>
                                    @foreach($accounts as $account)
                                       <option value="{{$account->account_id}}">{{$account->account_code_long}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="customer_id" class="col-sm-3 control-label">Customer Name</label>
                            <div class="col-sm-4">
                                <select name="customer_id" id="customer_id" class="form-control select21" style="width:100%">
                                    <option></option>
                                    @foreach($customers as $customer)
                                       <option value="{{$customer->customer_id}}">{{$customer->customer_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="customer_account_id" class="col-sm-3 control-label">Customer Account Name</label>
                            <div class="col-sm-4">
                                <select name="customer_account_id" id="customer_account_id" class="form-control select21" style="width:100%">
                                    <option></option>
                                    @foreach($accounts as $account)
                                       <option value="{{$account->account_id}}">{{$account->account_code_long}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exchange_id" class="col-sm-3 control-label">Exchange Name</label>
                            <div class="col-sm-4">
                                <select name="exchange_id" id="exchange_id" class="form-control select21" style="width:100%">
                                    <option></option>
                                    @foreach($exchanges as $exchange)
                                       <option value="{{$exchange->exchange_id}}">{{$exchange->exchange_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="asset_id" class="col-sm-3 control-label">Asset Name</label>
                            <div class="col-sm-4">
                                <select name="asset_id" id="asset_id" class="form-control select21" style="width:100%">
                                    <option></option>
                                    @foreach($assets as $asset)
                                       <option value="{{$asset->asset_id}}">{{$asset->asset_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="entry_timezone" class="col-sm-3 control-label">Entry Timezone</label>
                            <div class="col-sm-4">
                                <select name="entry_timezone" id="entry_timezone" class="form-control select21" style="width:100%">
                                    <option></option>
                                    @foreach($timezones as $timezone)
                                       <option value="{{$timezone->timezone_id}}">{{$timezone->timezone_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="entry_date" class="col-sm-3 control-label">Entry Date</label>
                            <div class="input-group col-sm-4" style="padding-left: 15px;padding-right: 15px;">
                                    <input id="entry_date" name="entry_date" type="text" value="<?= date('Y-m-d') ?>" class="form-control pull-left" data-language='en' /> 
                                    <div class="input-group-addon">
                                        <i class="fa fa-fw fa-calendar"></i>
                                    </div> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="entry_time" class="col-sm-3 control-label">Entry Time</label>
                            <div class="input-group col-sm-4" style="padding-left: 15px;padding-right: 15px;">
                                <input id="entry_time" name="entry_time" type="text" value="20:00" class="form-control required">
                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price_average" class="col-sm-3 control-label">Price Average</label>
                            <div class="col-sm-4">
                                <input id="price_average" name = "price_average" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="trade_exposure" class="col-sm-3 control-label">Trade Exposure</label>
                            <div class="col-sm-4">
                                <input id="trade_exposure" name = "trade_exposure" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="settlement_limit" class="col-sm-3 control-label">Settlement Limit</label>
                            <div class="col-sm-4">
                                <input id="settlement_limit" name = "settlement_limit" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="settlement_limit_status" class="col-sm-3 control-label">Settlement Limit Status</label>
                            <div class="col-sm-4">
                                <select name="settlement_limit_status" id="settlement_limit_status" class="form-control select21" style="width:100%">
                                    <option></option>
                                    @foreach($trade_status_types as $trade_status_type)
                                       <option value="{{$trade_status_type->trade_status_id}}">{{$trade_status_type->trade_status_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="trading_limit_status" class="col-sm-3 control-label">Trading Limit Status</label>
                            <div class="col-sm-4">
                                <select name="trading_limit_status" id="trading_limit_status" class="form-control select21" style="width:100%">
                                    <option></option>
                                    @foreach($trade_status_types as $trade_status_type)
                                       <option value="{{$trade_status_type->trade_status_id}}">{{$trade_status_type->trade_status_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="trade_limit" class="col-sm-3 control-label">Trade Limit</label>
                            <div class="col-sm-4">
                                <input id="trade_limit" name = "trade_limit" type="number" class="form-control">
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
<script type="text/javascript" src="{{asset('assets/js/custom_js/TradeRiskCreate.js')}}"></script>
@stop
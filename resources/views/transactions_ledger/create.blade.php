@extends('layouts/default')
{{-- Page title --}}
@section('title')
    Create Transaction Ledger
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/select2/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/select2/css/select2-bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}">
    <link href="{{asset('assets/vendors/airdatepicker/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/timedropper/css/timedropper.css')}}">
    <!--end of page level css-->
@stop
@section('content')

<section class="content-header">
    <h1>Create Transaction Ledger</h1>
    <ol class="breadcrumb">
        <li>
            <a href="index ">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li class="active">
            Transaction Ledger
        </li>
    </ol>
</section>
<section class="content">
    <form id="transactions_ledger" method='POST' action='{!!url("transactions_ledger")!!}' class="form-horizontal">
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" name="submitBtn" value="Save" class='btn btn-primary btn-inline'>Save</button>
                <button type="submit" name="submitBtn" value="SaveClose" class= 'btn btn-primary btn-inline'>Save &amp; Close</button>
                <a href="{{url('transactions_ledger')}}" class='btn btn-primary btn-inline'>
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
                            <i class="livicon" data-name="user-add" data-size="18" data-c="#fff" data-hc="#fff" data-loop="true"></i> Add New Transaction Ledger
                        </h3>
                        <span class="pull-right">
                            <i class="fa fa-fw fa-chevron-up clickable"></i>
                        </span>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="ledger_id" class="col-sm-2 control-label">Ledger ID</label>
                            <div class="col-sm-5">
                                <input id="ledger_id" name="ledger_id" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="order_id" class="col-sm-2 control-label">Order ID</label>
                            <div class="col-sm-5">
                                <input id="order_id" name="order_id" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="trader_id" class="col-sm-2 control-label">Trader Name</label>
                            <div class="col-sm-5">
                                <select name="trader_id" id="trader_id" class="select21 form-control">
                                    <option></option>
                                    @foreach($hase_staffs as $hase_staff)
                                        <option value="{{$hase_staff->staff_id}}">{{$hase_staff->staff_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="client_id" class="col-sm-2 control-label">Client Name</label>
                            <div class="col-sm-5">
                                <select name="client_id" id="client_id" class="select21 form-control">
                                    <option></option>
                                    @foreach($accounts as $account)
                                        <option value="{{$account->account_id}}">{{$account->account_code_long." (".$account->account_code_short.")"}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="account_id" class="col-sm-2 control-label">Account ID</label>
                            <div class="col-sm-5">
                                <input id="account_id" name="account_id" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exchange_id" class="col-sm-2 control-label">Exchange Name</label>
                            <div class="col-sm-5">
                                <select name="exchange_id" id="exchange_id" class="select21 form-control">
                                    <option></option>
                                    @foreach($exchanges as $exchange)
                                        <option value="{{$exchange->exchange_id}}">{{$exchange->identity_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="trade_timezone" class="col-sm-2 control-label">Timezone Name</label>
                            <div class="col-sm-5">
                                <select name="trade_timezone" id="trade_timezone" class="select21 form-control">
                                    <option></option>
                                    @foreach($timezones as $timezone)
                                        <option value="{{$timezone->timezone_id}}">{{$timezone->timezone_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="trade_date" class="col-sm-2 control-label">Trade Date</label>
                            <div class="col-sm-5">
                                <input id="trade_date" name="trade_date" type="text" class="form-control pull-left" data-language='en' placeholder="MM/DD/YYYY"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="trade_time" class="col-sm-2 control-label">Trade Time</label>
                            <div class="input-group col-sm-4" style="padding-left: 15px;">
                                <input id="trade_time" name="trade_time" type="text" value="20:00" class="form-control required">
                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="side_type_id" class="col-sm-2 control-label">Trade Side Type</label>
                            <div class="col-sm-5">
                                <select name="side_type_id" id="side_type_id" class="select21 form-control">
                                    <option></option>
                                    @foreach($sideTypes as $sideType)
                                        <option value="{{$sideType->side_type_id}}">{{$sideType->side_type_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Asset From -->
                        <div class="form-group">
                            <label for="asset_from_id" class="col-sm-2 control-label">Asset From</label>
                            <div class="col-sm-5">
                                <select name="asset_from_id" id="asset_from_id" class="select21 form-control">
                                    <option></option>
                                    @foreach($assets as $asset)
                                        <option value="{{$asset->asset_id}}">{{$asset->identity_code}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="asset_from_price" class="col-sm-2 control-label">Asset From Price</label>
                            <div class="col-sm-5">
                                <input id="asset_from_price" name="asset_from_price" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="asset_from_quantity" class="col-sm-2 control-label">Asset From Quantity</label>
                            <div class="col-sm-5">
                                <input id="asset_from_quantity" name="asset_from_quantity" type="text" class="form-control">
                            </div>
                        </div>
                        <!-- END: Asset From -->

                        <!-- Asset Into -->
                        <div class="form-group">
                            <label for="asset_into_id" class="col-sm-2 control-label">Asset Into</label>
                            <div class="col-sm-5">
                                <select name="asset_into_id" id="asset_into_id" class="select21 form-control">
                                    <option></option>
                                    @foreach($assets as $asset)
                                        <option value="{{$asset->asset_id}}">{{$asset->identity_code}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="asset_into_price" class="col-sm-2 control-label">Asset Into Price</label>
                            <div class="col-sm-5">
                                <input id="asset_into_price" name="asset_into_price" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="asset_into_quantity" class="col-sm-2 control-label">Asset Into Quantity</label>
                            <div class="col-sm-5">
                                <input id="asset_into_quantity" name="asset_into_quantity" type="text" class="form-control">
                            </div>
                        </div>
                        <!-- END: Asset Into -->

                        <!-- Trade Types -->
                        <div class="form-group">
                            <label for="order_type_id" class="col-sm-2 control-label">Trade Order Type</label>
                            <div class="col-sm-5">
                                <select name="order_type_id" id="order_type_id" class="select21 form-control">
                                    <option></option>
                                    @foreach($tradeOrderTypes as $tradeOrderType)
                                        <option value="{{$tradeOrderType->trade_order_type_id}}">{{$tradeOrderType->trade_order_type_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status_type_id" class="col-sm-2 control-label">Trade Status Type</label>
                            <div class="col-sm-5">
                                <select name="status_type_id" id="status_type_id" class="select21 form-control">
                                    <option></option>
                                    @foreach($tradeStatusTypes as $tradeStatusType)
                                        <option value="{{$tradeStatusType->trade_status_id}}">{{$tradeStatusType-> trade_status_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reason_type_id" class="col-sm-2 control-label">Trade Reason Type</label>
                            <div class="col-sm-5">
                                <select name="reason_type_id" id="reason_type_id" class="select21 form-control">
                                    <option></option>
                                    @foreach($tradeReasonTypes as $tradeReasonType)
                                        <option value="{{$tradeReasonType->trade_reason_type_id}}">{{$tradeReasonType-> trade_reason_type_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- END: Trade Types -->

                        <!-- Fee Amount -->
                        <div class="form-group">
                            <label for="fee_asset_id" class="col-sm-2 control-label">Fee Asset</label>
                            <div class="col-sm-5">
                                <select name="fee_asset_id" id="fee_asset_id" class="select21 form-control">
                                    <option></option>
                                    @foreach($assets as $asset)
                                        <option value="{{$asset->asset_id}}">{{$asset->identity_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fee_amount" class="col-sm-2 control-label">Fee Amount</label>
                            <div class="col-sm-5">
                                <input id="fee_amount" name="fee_amount" type="text" class="form-control">
                            </div>
                        </div>
                        <!-- END: Fee Amount -->

                        <!-- Transactions -->
                        <div class="form-group">
                            <label for="transaction_address" class="col-sm-2 control-label">Transaction Address</label>
                            <div class="col-sm-5">
                                <input id="transaction_address" name="transaction_address" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="transaction_address_url" class="col-sm-2 control-label">Transaction Address Url</label>
                            <div class="col-sm-5">
                                <input id="transaction_address_url" name="transaction_address_url" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="transaction_type_id" class="col-sm-2 control-label">Trade Transaction Type</label>
                            <div class="col-sm-5">
                                <select name="transaction_type_id" id="transaction_type_id" class="select21 form-control">
                                    <option></option>
                                    @foreach($tradeTransactionTypes as $tradeTransactionType)
                                        <option value="{{$tradeTransactionType->trade_transaction_type_id}}">{{$tradeTransactionType-> trade_transaction_type_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="transaction_exchange" class="col-sm-2 control-label">Transaction Exchange</label>
                            <div class="col-sm-5">
                                <input id="transaction_exchange" name="transaction_exchange" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="transaction_internal" class="col-sm-2 control-label">Transaction Internal</label>
                            <div class="col-sm-5">
                                <input id="transaction_internal" name="transaction_internal" type="text" class="form-control">
                            </div>
                        </div>
                        <!-- END : Transactions -->
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
<script type="text/javascript" src="{{asset('assets/vendors/timedropper/js/timedropper.js')}}" ></script>
<script type="text/javascript" src="{{asset('assets/vendors/select2/js/select2.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom_js/TransactionLedgerCreate.js')}}"></script>
<!-- end of page level js -->
@stop
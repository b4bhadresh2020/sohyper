@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Asset
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/select2/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/select2/css/select2-bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}">
    <link href="{{asset('assets/vendors/airdatepicker/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">
    <!--end of page level css-->
@stop
@section('content')
<section class="content-header">
    <h1>Edit Asset</h1>
    <ol class="breadcrumb">
        <li>
            <a href="index ">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        
        <li class="active">
            Asset
        </li>
    </ol>
</section>
<section class="content">
    <form id="assetForm"  action = '{!! url("asset")!!}/{!!$asset->
        asset_id!!}/update' method = 'POST' class="form-horizontal" role="form" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <button type="submit" name="submitBtn" value="Save" class='btn btn-primary btn-inline'>Save</button>
                <button type="submit" name="submitBtn" value="SaveClose" class = 'btn btn-primary btn-inline'>Save  &amp; close</button>
                <a href="{!!url("asset")!!}" class='btn btn-primary btn-inline'>
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
                            <i class="fa fa-fw fa-crosshairs"></i> Edit Asset Detail
                        </h3>
                    </div>
                    <div class="panel-body">
                        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                        <input type = 'hidden' name = 'asset_id' value = '{!!$asset->asset_id!!}'>
                        <div class="form-group">
                            <label for="asset_symbol" class="col-sm-3">Asset Code</label>
                            <div class="col-sm-8">
                                <input id="asset_symbol" name="asset_symbol" type="text" class="form-control" value="{!!$asset->asset_symbol!!}">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="asset_name" class="col-sm-3">Asset Name</label>
                            <div class="col-sm-8">
                                <input id="asset_name" name="asset_name" type="text" class="form-control" value="{!!$asset->asset_name!!}">
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="asset_type_id" class="col-sm-3">Asset Type Code</label>
                            <div class="col-sm-8">
                                <select name="asset_type_id" id="asset_type_id" class="form-control select21" style="width:100%">
                                    <option></option>
                                    @foreach($assetTypes as $assetType)
                                        @if($assetType->asset_type_id == $asset->asset_type_id)
                                            <option value="{{$assetType->asset_type_id}}" selected>{{$assetType->asset_type_code}}</option>
                                        @else
                                            <option value="{{$assetType->asset_type_id}}">{{$assetType->asset_type_code}}</option>
                                        @endif    
                                    @endforeach
                                </select>
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
<script type="text/javascript" src="{{asset('assets/vendors/select2/js/select2.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom_js/AssetEdit.js')}}"></script>
@stop
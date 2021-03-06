@extends('layouts/default')
{{-- Page title --}}
@section('title')
    Criteria
    @parent
@stop
@section('header_styles')
<link rel="stylesheet" type="text/css" href="assets/kendoui/styles/kendo.common.min.css">
<link rel="stylesheet" type="text/css" href="assets/kendoui/styles/kendo.mobile.all.min.css">
<link rel="stylesheet" type="text/css" href="assets/kendoui/styles/kendo.blueopal.min.css">
<style type="text/css">
    .k-grid-content { min-height:80px; }
</style>
<!--end of page level css-->
@stop
@section('content')
<section class="content-header">
    <h1>Criteria</h1>
    <ol class="breadcrumb">
        <li>
            <a href="index ">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li class="active">
            Criteria
        </li>
    </ol>
</section>
<section class="content">
    <div id="top_modal" class="modal fade animated position_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: white;">
                <div class="modal-header" style="background-color: #d9ecf5;color: black">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Model-Title</h4>
                </div>
                <div class="modal-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="panel-title">    
                                <i class="fa fa-fw fa-users"></i> Panel-Title
                            </h4>
                        </div>
                        <div class="panel-body">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type='button' class='venue_criteria k-button'>Import Criteria</button><br><br>
    <section class="content p-l-r-15">
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">    
                        <i class="fa fa-fw fa-users"></i> Criteria
                    </h4>
                </div>
                <div class="panel-body">
                    <input type="hidden" id="requestUrl" value="{!!url(Request::segment(1))!!}">
                    <div id="tabstrip">
                        <ul id="venue_criteria_list">
                            <li class="k-state-active" >Venue Criteria</li>
                            <li>Production Criteria</li>
                            <li>Instances Events</li>
                            <li id="exceptionsTab" style="display: none;">Exceptions</li>
                        </ul>
                        <div id="tab1">
                            <div id="Venue_criteriaGrid"></div>
                        </div>
                        <div id="tab2">
                            <div id="productionCriteriaGrid"></div>
                        </div>
                        <div id="tab3">
                            <div id="Instances_eventsGrid"></div>
                        </div>
                        <div id="tab4">
                            <div id="CriteriaExceptionsGrid"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- form-modal -->
                <div id="venue_criteria_top_modal" class="modal fade animated position_modal" role="dialog">
                    <div class="modal-dialog">
                    <div class="modal-content" style="background-color: #d9ecf5">
                        <div class="modal-header" style="background-color: #d9ecf5;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Import Criteria</h4>
                        </div>
                        <div class="panel panel-primary" style="border-color: snow;">
                            <div class="panel-body" >
                                <div class="preloader" style="background: none !important; ">
                                    <div class="loader_img">
                                        <img src="{{asset('assets/img/loader.gif')}}" alt="loading..." height="64" width="64">
                                    </div>
                                </div>
                                <div class="row">
                                    <form id="add_venue_criteria_form">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="add_venue_criteria" class="col-sm-3">Upload File</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="fileToUpload[]" id="fileToUpload" multiple="multiple" aria-label="fileToUpload">
                                            </div>
                                        </div><br><br><br><br>
                                        <div class="form-group">
                                            <label for="live_Url" class="col-sm-3 control-label">Enter Json Url</label>
                                            <div class="col-sm-9"> 
                                                <input type="text" name="jsonUrl" id="jsonUrl" class="form-control"/>
                                            </div>
                                        </div><br><br>
                                        <div class="form-group">
                                            <label for="add_venue_criteria" class="col-sm-3"></label>
                                            <div class="col-sm-9">
                                                <input type="submit" value="Upload File" name="submit" class="criteriaJsonUpload k-button">
                                            </div>
                                        </div>
                                    </form>
                                </div><br>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- form-modal end -->
    </section>
</section>
@endsection
{{-- page level scripts --}}
<script src="assets/kendoui/js/jquery.min.js" type="text/javascript"></script>
@section('footer_scripts')
<script type="text/javascript" src="{{asset('assets/kendoui/js/kendo.all.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/custom_js/Venue_criteria/Venue_criteria.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/custom_js/Production_criteria/Production_criteria.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/custom_js/Instances_events/Instances_events.js')}}"></script>
    <script id="Instances_eventsSearch" type="text/x-kendo-template">
        <div class="searchToolBar" style="float: right;">
            <label class="search-label" for="searchBox">Search Grid:</label>
            <input type="search" id="Instances_eventsSearchBox" class="k-textbox" style="width: 250px"/>
            <input type="button" id="Instances_eventsBtnSearch" class="k-button" value="Search"/>
            <input type="button" id="Instances_eventsBtnReset" class="k-button" value="Reset"/>
        </div>
    </script>
    <script type="text/x-kendo-template" id="jsonDetailsTemplate">
        Section: #= section #</br>
        MaxPrice: #= MaxPrice #</br>
        MinPrice: #= MinPrice #</br>
        MinQty: #= MinQty #</br>
        Filter: #= Filter #</br>
        DeliveryId: #= DeliveryId #</br>
        AutoBuy: #= AutoBuy #</br> 
        # if (max_quantity == '' ) 
        {# #} else {# Max Quantity: #= max_quantity #</br> #}#  
        # if (reference_id == '' ) 
        {# #} else {# Reference Id: #= reference_id #</br>#}#
         # if (broker_ids == '' ) 
        {# #} else {# Broker Ids: #= broker_ids #</br>#}#
         # if (purchase_wait == '' ) 
        {# #} else {# Broker Ids: #= broker_ids #</br> #}#
         # if (referencePercent == '' ) 
        {# #} else {# Reference Percent: #= referencePercent #</br>#}#   
    </script>
    <script id="Venue_criteriaSearch" type="text/x-kendo-template">
        <div class="submitcheckboxDiv" style="float: left;display:block;">
            <button type="button" class='k-button' onclick="submitBatchData('selected')">Selected</button>
            <button type="button" class='k-button' onclick="submitBatchData('all')">All</button>
        </div>
        <div class="searchToolBar" style="float: right;">
            <label class="search-label" for="searchBox">Search Grid:</label>
            <input type="search" id="Venue_criteriaSearchBox" class="k-textbox" style="width: 250px"/>
            <input type="button" id="Venue_criteriaBtnSearch" class="k-button" value="Search"/>
            <input type="button" id="Venue_criteriaBtnReset" class="k-button" value="Reset"/>
        </div>
    </script>
    <script id="CriteriaJsonDetailsSearch" type="text/x-kendo-template">
        <div class="searchToolBar" style="float: right;">
            <label class="search-label" for="searchBox">Search Grid:</label>
            <input type="search" id="CriteriaJsonDetailsSearchBox" class="k-textbox" style="width: 250px"/>
            <input type="button" id="CriteriaJsonDetailsBtnSearch" class="k-button" value="Search"/>
            <input type="button" id="CriteriaJsonDetailsBtnReset" class="k-button" value="Reset"/>
        </div>
    </script>
    <script id="productionCriteriaHeaderAction" type="text/x-kendo-template">
        <div class="submitcheckboxDiv" style="float: left;display:block;">
            <button type="button" class='k-button' onclick="submitBatchData('selected')">Selected</button>
            <button type="button" class='k-button' onclick="submitBatchData('all')">All</button>
        </div>
        <div class="searchToolBar" style="float: right;">
            <label class="search-label" for="searchBox">Search Grid:</label>
            <input type="search" id="productionCriteriaSearchBox" class="k-textbox" style="width: 250px"/>
            <input type="button" id="productionCriteriaBtnSearch" class="k-button" value="Search"/>
            <input type="button" id="productionCriteriaBtnReset" class="k-button" value="Reset"/>
        </div>
    </script>
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
            var $toast = toastr["{{ Session::get('type') }}"]("", "{{ Session::get('msg') }}");
        @endif
    </script>
@stop
@extends('layouts/default')
{{-- Page title --}}
@section('title')
    Asset Rates
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datatables/css/dataTables.bootstrap.css')}}"/>
    <!--end of page level css-->
@stop
@section('content')

<section class="content-header">
    <h1>Asset Rates</h1>
    <ol class="breadcrumb">
        <li>
            <a href="index ">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li class="active">
            Asset Rates
        </li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php if(in_array("add", $permissions)): ?>
                <a href='{!!url("asset_rate")!!}/create' class='btn btn-primary btn-inline'>Create New Asset Rate</a>
            <?php endif; ?>
        </div>
    </div>
    <br>
    <section class="content p-l-r-15">
        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-fw fa-square-o"></i> Asset Rates List
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class = "table table-bordered" id="table">
                            <thead>
                                <?php if(in_array("manage", $permissions) || in_array("delete", $permissions)):?>
                                    <th>Actions</th>
                                <?php endif; ?>
                                <th>Id</th>
                                <th>Asset From</th>
                                <th>Asset Into</th>
                                <th>Asset Bid Price</th>
                                <th>Asset Ask Price</th>
                                <th>Asset Last Price</th>
                                <!--<th>Asset Last Date</th>
                                <th>Asset Last Time</th>
                                <th>Asset Last Timezone</th>-->
                            </thead>
                            <tbody>
                                @foreach($asset_rates as $asset_rate) 
                                    <tr>
                                        <?php if(in_array("manage", $permissions) || in_array("delete", $permissions)):?>
                                            <td>
                                                <?php if(in_array("manage", $permissions)): ?>
                                                    <a href = '{!!url("asset_rate")!!}/{!!$asset_rate->rate_id!!}/edit'><i class = 'fa fa-fw fa-pencil text-primary actions_icon' title="Edit Table"></i></a>
                                                <?php endif; ?>

                                                <?php if(in_array("delete", $permissions)): ?>
                                                    <a href='#' data-toggle="modal" data-target="#delete" data-link = '{!!url("asset_rate")!!}/{!!$asset_rate->rate_id!!}/delete'><i class = 'fa fa-fw fa-times text-danger actions_icon' title="Delete Table"></i></a>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                        <td>{!!$asset_rate->rate_id!!}</td>
                                        <td>{!!$asset_rate->asset_from_code!!}</td>
                                        <td>{!!$asset_rate->asset_into_code!!}</td>
                                        <td>{!!$asset_rate->asset_bid_price!!}</td>
                                        <td>{!!$asset_rate->asset_ask_price!!}</td>
                                        <td>{!!$asset_rate->asset_last_price!!}</td>
                                        
                                        <!--<td>{{($asset_rate->asset_last_date)?date('m-d-Y',strtotime($asset_rate->asset_last_date)):''}}</td>
                                        <td>{{($asset_rate->asset_last_time)?date('H:i',$asset_rate->asset_last_time):''}}</td>
                                        
                                        <td>{!!$asset_rate->timezone_name!!}</td>-->
                                    </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.modal-dialog -->
            <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="Heading" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Delete Asset Rate</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-warning">
                                <span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to
                                delete this Asset Rate ?
                            </div>
                        </div>
                        <div class="modal-footer ">
                            <a href="#" class="btn btn-danger">
                                <span class="glyphicon glyphicon-ok-sign"></span> Yes
                            </a>
                            <button type="button" class="btn btn-success" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove"></span> No
                            </button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>
            <!-- /.modal-dialog -->
        </div>
    </section>
</section>
@endsection

{{-- page level scripts --}}
@section('footer_scripts')
<!-- begining of page level js -->

<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/jquery.dataTables.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom_js/users_custom.js')}}"></script>
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
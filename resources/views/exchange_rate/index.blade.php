@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Exchange Asset Rates
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
    <h1>Exchange Asset Rates</h1>
    <ol class="breadcrumb">
        <li>
            <a href="index ">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li class="active">
            Exchange Asset Rates
        </li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php if(in_array("add", $permissions)): ?>
            <a href='{!!url("exchange_rates")!!}/create' class='btn btn-primary btn-inline'>Create New Exchange Asset Rates
            </a>
            <?php endif; ?>
        </div>
    </div>
    <br>
    <section class="content p-l-r-15">
        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title">    
                        <i class="fa fa-fw fa-users"></i> Exchange Asset Rates List
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table">
                            
                            <thead>
                                <?php if(in_array("manage", $permissions) || in_array("delete", $permissions)):?>
                                <th>Actions</th>
                                <?php endif; ?>
                                <th>Exchange Rate Id</th>
                                <th>Exchange Name</th>
                                <th>Base Currency</th>
                                <th>QuoteCurrency</th>
                                <th>Volume currency</th>
                                <th>Level Margin Call</th>
                                <th>Level Margin Liquidation</th>
                                <th>Leverage Buy</th>
                                <th>Leverage Sell</th>
                                <th>Margin Percent</th>
                                <th>Funding Start</th>
                                <th>Funding Interval</th>
                                <th>Funding Rate</th>
                            </thead>
                            <tbody>
                                @foreach($exchange_rates as $exchange_rate) 
                                <tr>
                                    <?php if(in_array("manage", $permissions) || in_array("delete", $permissions)):?>
                                    <td>
                                        <?php if(in_array("manage", $permissions)): ?>
                                        <a href="{!!url('exchange_rates')!!}/{!!$exchange_rate->rate_id!!}/edit"><i class="fa fa-fw fa-pencil text-primary actions_icon" title="Edit Exchange"></i>
                                        </a>
                                        <?php endif; ?>

                                        <?php if(in_array("delete", $permissions)): ?>
                                        <a href="#" data-toggle="modal" data-target="#delete" data-link = "{!!url('exchange_rates')!!}/{!!$exchange_rate->rate_id!!}/delete"><i class="fa fa-fw fa-times text-danger actions_icon" title="Delete Exchange"></i></a>
                                        <?php endif; ?>
                                    </td>
                                    <?php endif; ?>
                                    <td>{!!$exchange_rate->rate_id!!}</td>
                                    <td>{!!$exchange_rate->exchange_name!!}</td>
                                    <td>{!!$exchange_rate->base_currency_name!!}</td>
                                    <td>{!!$exchange_rate->quote_currency_name!!}</td>
                                    <td>{!!$exchange_rate->volume_currency_name!!}</td>
                                    <td>{!!$exchange_rate->level_margin_call!!}</td>
                                    <td>{!!$exchange_rate->level_margin_liquidation!!}</td>
                                    <td>{!!$exchange_rate->leverage_buy!!}</td>
                                    <td>{!!$exchange_rate->leverage_sell!!}</td>
                                    <td>{!!$exchange_rate->margin_percent!!}</td>
                                    <td><?php
                                            if($exchange_rate->funding_start != 0) {
                                                echo substr_replace(substr_replace($exchange_rate->funding_start, '-', 4, 0), '-', 7, 0);
                                            }
                                        ?></td>
                                    <td>{!!$exchange_rate->funding_interval!!}</td>
                                    <td>{!!$exchange_rate->funding_rate!!}</td>
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="Heading" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Delete Exchange</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-warning">
                                <span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Exchange?
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
@stop
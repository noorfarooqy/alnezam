@extends('layouts.mainlayout')

@section('body-content')
<div class="container-fluid">

    <div class="row mt-3">
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card gradient-shifter">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="w-icon pr-3">
                            <i class="fa fa-money text-white"></i></div>
                        <div class="media-body pl-3 border-left border-white-2">
                            <h5 class="text-white mb-0">$0 <small class="small-font">(0%)</small></h5>
                            <span class="text-white small-font">Total Revenue</span>
                        </div>
                    </div>
                </div>
                <div class="chart-container-7">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card gradient-forest">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="w-icon pr-3">
                            <i class="fa fa-usd text-white"></i></div>
                        <div class="media-body pl-3 border-left border-white-2">
                            <h5 class="text-white mb-0">0 <small class="small-font">(0%)</small></h5>
                            <span class="text-white small-font">Total Profit</span>
                        </div>
                    </div>
                </div>
                <div class="chart-container-7">
                    <canvas id="profitChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-12 col-xl-4">
            <div class="card gradient-deepblue">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="w-icon pr-3">
                            <i class="fa fa-truck text-white"></i></div>
                        <div class="media-body pl-3 border-left border-white-2">
                            <h5 class="text-white mb-0">0 <small class="small-font">(0%)</small></h5>
                            <span class="text-white small-font">Total Shipments</span>
                        </div>
                    </div>
                </div>
                <div class="chart-container-7">
                    <canvas id="shipmentChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!--End Row-->

    <div class="row">
        <div class="col-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header">Avg Delivery Time (hours) & Route (km)
                    <div class="card-action">
                        <div class="dropdown">
                            <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret"
                                data-toggle="dropdown">
                                <i class="icon-options"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="javascript:void();">Action</a>
                                <a class="dropdown-item" href="javascript:void();">Another action</a>
                                <a class="dropdown-item" href="javascript:void();">Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void();">Separated link</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container-11">
                        <canvas id="timeChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Row-->

    <div class="row">
        <div class="col-12 col-lg-12 col-xl-12">
            <div class="card gradient-ohhappiness">
                <div class="card-body">
                    <div class="row row-group align-items-center">
                        <div class="col-12 col-lg-3 text-center p-3 border-white-2">
                            <div class="fleet-status fleet-chart" data-percent="65">
                                <span class="fleet-status-percent"></span>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 text-center p-3  border-white-2">
                            <h4 class="mb-0 text-white">65%</h4>
                            <p class="mb-0 small-font text-white">Fleet Efficiency</p>
                        </div>
                        <div class="col-12 col-lg-5 p-3">
                            <ul>
                                <li class="text-white">Total fleet : 63</li>
                                <li class="text-white">On the move : 60</li>
                                <li class="text-white">In Maintenence : 3</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Row-->

    <div class="row">
        <div class="col-12 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="media-body text-left">
                            <h4 class="text-primary mb-0">28min</h4>
                            <span class="small-font">Avg Loading Time</span>
                        </div>
                        <div class="w-circle-icon rounded bg-primary">
                            <i class="fa fa-clock-o text-white"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="media-body text-left">
                            <h4 class="text-secondary mb-0">15 tons</h4>
                            <span class="small-font">Avg Loading Weight</span>
                        </div>
                        <div class="w-circle-icon rounded bg-secondary">
                            <i class="fa fa-tasks text-white"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Row-->


    <div class="row">
        <div class="col-12 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-header">Delivery Status</div>
                <div class="card-body">
                    <div class="chart-container-5">
                        <canvas id="deliverychart"></canvas>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Within Time Limit : <span
                            class="badge badge-warning float-right">325</span></li>
                    <li class="list-group-item">Out of Time Limit : <span
                            class="badge badge-info float-right">45</span></li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-header">Deliveries by Country</div>
                <div class="card-body">
                    <div class="chart-container-6">
                        <canvas id="regionchart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Row-->
    <!--start overlay-->
    <div class="overlay toggle-menu"></div>
    <!--end overlay-->
</div>
@endsection
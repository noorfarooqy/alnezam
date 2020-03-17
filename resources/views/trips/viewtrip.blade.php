@extends('layouts.mainlayout')
@section('links')
    
  <link href="/assets/plugins/bootstrap-switch/bootstrap-switch.min.css" rel="stylesheet">
 
  <!--Select Plugins-->
  <link href="/assets/plugins/select2/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('scripts')
    
    <!--Select Plugins Js-->
    <script src="/assets/plugins/select2/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.single-select').select2();
        });
    </script>

    <!--Bootstrap Switch Buttons-->
    <script src="/assets/plugins/bootstrap-switch/bootstrap-switch.min.js"></script>
    <script>
    $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
    var radioswitch = function() {
        var bt = function() {
            $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioState")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
            })
        };
        return {
            init: function() {
                bt()
            }
        }
    }();
    $(document).ready(function() {
        radioswitch.init()
    });
    </script>

    <script src="/js/tripitems.js"></script>
@endsection
@section('body-content')
<div class="container-fluid">
    <div class="row">
        
        <div class="card" style="width:100%">
            <div class="card-header">
                Trip details
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="exampleInputUsername" class="sr-only">Trip name</label>
                            <div class="position-relative has-icon-right">
                                <input type="text" id="exampleInputUsername" name="trip_name" class="form-control input-shadow"
                                    placeholder="Enter Trip name" value="{{$tripdata->trip_name}}" disabled>
                                <div class="form-control-position">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="exampleInputUsername" class="sr-only">Karani in charge</label>
                            <div class="position-relative has-icon-right">
                                <input type="text" id="exampleInputUsername" name="trip_name" class="form-control input-shadow"
                                    placeholder="Enter Trip name" value="{{ $tripdata->karaniInfo->karani_name }}" disabled>
                                <div class="form-control-position">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Add items
                    </div>
                    <div class="card-body">
                        
                        <form action="">
                            <div class="row">
                                <div class="col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label for="exampleInputUsername" class="sr-only">Item name</label>
                                        <div class="position-relative has-icon-right">
                                            <input type="text" id="exampleInputUsername" name="item_name" class="form-control input-shadow"
                                                placeholder="Enter Item name" >
                                            <div class="form-control-position">
                                                <i class="zmdi zmdi-collection-item"></i>
                                            </div>
                                            @error('trip_name')
                                            <span class="error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    
                                    <div class="form-group">
                                        <label for="exampleInputUsername" class="sr-only">Quantity</label>
                                        <div class="position-relative has-icon-right">
                                            <input type="text" id="exampleInputUsername" name="item_quantity" class="form-control input-shadow"
                                                placeholder="Enter Item quantity" >
                                            <div class="form-control-position">
                                                <i class="fa fa-list-ol"></i>
                                            </div>
                                            @error('item_quantity')
                                            <span class="error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    
                                    <div class="form-group">
                                        <label for="exampleInputUsername" class="sr-only">Price</label>
                                        <div class="position-relative has-icon-right">
                                            <input type="text" id="exampleInputUsername" name="item_price" class="form-control input-shadow"
                                                placeholder="Enter Item price" >
                                            <div class="form-control-position">
                                                <i class="zmdi zmdi-money-box"></i>
                                            </div>
                                            @error('item_price')
                                            <span class="error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <input type="text" disabled value="AED 0.00" class="form-control">
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <input type="text" disabled value="USD 0.00" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-lg-3">

                                    <select class="form-control single-select" name="launch">
                                        <option value="-1">Select Client Mark</option>
                                        @foreach ($customerlist as $customer)
                                        <option value="{{$customer->id}}">{{$customer->client_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <input type="text" disabled class="form-control" value="Client name">
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <button class="btn btn-info">
                                        <i class="fa fa-plus-square"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row mb-4 ml-1">
                                *ff client doesn't exist <a href=""> Add new client here </a>
                            </div>
                            
                        </form>
                        <div class="table-responsive">

                            <table id="example" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Item name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total AED</th>
                                        <th>Total USD</th>
                                        <th>Mark as paid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Item name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total AED</th>
                                        <th>Total USD</th>
                                        <th>Mark as paid</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>TOTAL DIRHAM </th>
                                        <th>
                                            AED 0.00
                                        </th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>TOTAL US DOLLAR </th>
                                        <th>
                                            USD 0.00
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection

@extends('layouts.mainlayout')
@section('links')
    
 
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
@endsection
@section('body-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-8 col-lg-8">
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
                                
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-lg-2"></div>
        
    </div>
</div>
@endsection

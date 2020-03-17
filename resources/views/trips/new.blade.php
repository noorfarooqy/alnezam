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
                        New Trip
                    </div>
                    <div class="card-body">
                        @if (isset($successmessage))
                        <div class=" alert alert-success text-align:center">
                            {{ $successmessage }}
                        </div>
                        @elseif(isset($error))
                        <div class=" alert alert-danger text-align:center">
                              @foreach ($error as $e)
                                  {{$e}}
                              @endforeach
                        </div>
                        @endif
                        <div class="row"></div>
                    <form action="{{route('new_trip')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <label>Select launch ship</label>
                                        <select class="form-control single-select" name="launch">
                                            <option value="-1">Select Ship</option>
                                            @foreach ($launchlist as $launch)
                                            <option value="{{$launch->id}}">{{$launch->launch_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('launch')
                                        <span class="error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label>Select Karani</label>
                                        <select class="form-control single-select" name="karani">
                                            
                                            <option value="-1">Select Karani</option>
                                            @foreach ($karanilist as $karani)
                                            <option value="{{$karani->id}}">{{$karani->karani_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('karani')
                                        <span class="error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                
                              </div>
                            <div class="form-group">
                                <label for="exampleInputUsername" class="sr-only">Trip name</label>
                                <div class="position-relative has-icon-right">
                                    <input type="text" id="exampleInputUsername" name="trip_name" class="form-control input-shadow"
                                        placeholder="Enter Trip name" value="{{old('trip_name')}}">
                                    <div class="form-control-position">
                                        <i class="icon-user"></i>
                                    </div>
                                    @error('trip_name')
                                    <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <label for="exampleInputUsername" class="sr-only">Loading port</label>
                                        <div class="position-relative has-icon-right">
                                            <input type="text" id="exampleInputUsername" name="loading_port" class="form-control input-shadow"
                                                placeholder="Enter loading port" value="{{old('loading_port')}}">
                                            <div class="form-control-position">
                                                <i class="zmdi zmdi-flight-takeoff"></i>
                                            </div>
                                            @error('loading_port')
                                            <span class="error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label for="exampleInputUsername" class="sr-only">Destination port</label>
                                        <div class="position-relative has-icon-right">
                                            <input type="text" id="exampleInputUsername" name="destination_port" class="form-control input-shadow"
                                                placeholder="Enter destination port" value="{{old('destination_port')}}">
                                            <div class="form-control-position">
                                                <i class="zmdi zmdi-flight-land"></i>
                                            </div>
                                            @error('destination_port')
                                            <span class="error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <input type="submit" class="btn btn-primary btn-block waves-effect waves-light" value="Add launch">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-lg-2"></div>
        
    </div>
</div>
@endsection

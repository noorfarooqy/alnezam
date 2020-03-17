@extends('layouts.mainlayout')

@section('body-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-8 col-lg-8">
            <div class="row">
                <div class="card" style="width:100%">
                    <div class="card-header">
                        New Launch
                    </div>
                    <div class="card-body">
                        @if (isset($successmessage))
                            <div class=" alert alert-success text-align:center">
                                {{ $successmessage }}
                            </div>
                        @endif
                        <div class="row"></div>
                    <form action="{{route('new_launch')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername" class="sr-only">Launch name</label>
                                <div class="position-relative has-icon-right">
                                    <input type="text" id="exampleInputUsername" name="launch_name" class="form-control input-shadow"
                                        placeholder="Enter Launch name" value="{{old('launch_name')}}">
                                    <div class="form-control-position">
                                        <i class="icon-user"></i>
                                    </div>
                                    @error('launch_name')
                                    <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername" class="sr-only">Owner name</label>
                                <div class="position-relative has-icon-right">
                                    <input type="text" id="exampleInputUsername" name="owner_name" class="form-control input-shadow"
                                        placeholder="Enter Owner name" value="{{old('owner_name')}}">
                                    <div class="form-control-position">
                                        <i class="icon-user"></i>
                                    </div>
                                    @error('owner_name')
                                    <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername" class="sr-only">Captain name</label>
                                <div class="position-relative has-icon-right">
                                    <input type="text" id="exampleInputUsername" name="captain_name" class="form-control input-shadow"
                                        placeholder="Enter Captain name" value="{{old('captain_name')}}">
                                    <div class="form-control-position">
                                        <i class="zmdi zmdi-exposure"></i>
                                    </div>
                                    @error('captain_name')
                                    <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername" class="sr-only">Average capacity</label>
                                <div class="position-relative has-icon-right">
                                    <input type="number" id="exampleInputUsername" name="average_capacity" class="form-control input-shadow"
                                placeholder="Enter Average capacity (Tonnes) " min="10" value="{{old('average_capacity')}}">
                                    <div class="form-control-position">
                                        <i class="zmdi zmdi-confirmation-number"></i>
                                    </div>
                                    @error('average_capacity')
                                    <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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

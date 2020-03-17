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
                        @endif
                        <div class="row"></div>
                    <form action="{{route('new_karani')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername" class="sr-only">Karani Email</label>
                                <div class="position-relative has-icon-right">
                                    <input type="email" id="exampleInputUsername" name="karani_email" class="form-control input-shadow"
                                        placeholder="Enter Karani email" value="{{old('karani_email')}}">
                                    <div class="form-control-position">
                                        <i class="icon-user"></i>
                                    </div>
                                    @error('karani_email')
                                    <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <label for="exampleInputUsername" class="sr-only">Karani name</label>
                                        <div class="position-relative has-icon-right">
                                            <input type="text" id="exampleInputUsername" name="karani_name" class="form-control input-shadow"
                                                placeholder="Enter karani name" value="{{old('karani_name')}}">
                                            <div class="form-control-position">
                                                <i class="zmdi zmdi-exposure"></i>
                                            </div>
                                            @error('karani_name')
                                            <span class="error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label for="exampleInputUsername" class="sr-only">Karani Telephone</label>
                                        <div class="position-relative has-icon-right">
                                            <input type="text" id="exampleInputUsername" name="karani_phone" class="form-control input-shadow"
                                                placeholder="Enter karani phone number" value="{{old('karani_phone')}}">
                                            <div class="form-control-position">
                                                <i class="zmdi zmdi-phone"></i>
                                            </div>
                                            @error('karani_phone')
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

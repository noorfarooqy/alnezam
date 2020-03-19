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
@section('pageTitle')
    Sharing Trip
@endsection
@section('body-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-8 col-lg-8">
            <div class="row mt-4">
                <div class="card" style="width:100%">
                    <div class="card-header">
                        Sharing {{$trip->trip_name}}
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
                        <form action="{{route('trip_share')}}" method="POST">
                            @csrf
                           
                            <div class="form-group">
                                <label for="exampleInputUsername" class="sr-only">Enter email to send link</label>
                                <div class="position-relative has-icon-right">
                                    <input type="email" id="exampleInputUsername" name="share_email" class="form-control input-shadow"
                                        placeholder="Enter Email to send trip" value="{{old('email')}}">
                                    <input type="hidden" value="{{$trip->id}}" name="trip_id">
                                    <div class="form-control-position">
                                        <i class="icon-user"></i>
                                    </div>
                                    @error('share_email')
                                    <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    @error('trip_id')
                                    <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <input type="submit" class="btn btn-primary btn-block waves-effect waves-light" value="Share">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-lg-2"></div>
        
    </div>
</div>
@endsection

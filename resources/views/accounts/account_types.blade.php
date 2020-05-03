@extends('layouts.mainlayout')
@section('links')

@endsection

@section('scripts')


@endsection
@section('pageTitle')
{{env('APP_NAME')}} - Accounts Types
@endsection
@section('body-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-1 col-lg-1"></div>
        <div class="col-md-10 col-lg-10">
            <!-- Breadcrumb-->
            <div class="row pt-2 pb-2">
                <div class="col-sm-9">
                    <h4 class="page-title"> Account</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javaScript:void();">Account types</a></li>
                        <li class="breadcrumb-item active" aria-current="page"></li>
                    </ol>
                </div>
                <div class="col-sm-3">
                    <div class="btn-group float-sm-right">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="card col-md-7 col-lg-7 border">
            <div class="card-header">
                List of account types
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Account type</th>
                              <th>Description</th>
                              <th>Created by</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($ac_types as $type)
                              <tr>
                                  <td></td>
                                  <td>
                                      <a href="/accounts/type/{{$type->id}}">{{$type->ac_type_name}}</a>
                                  </td>
                                  <td>
                                      {{$type->ac_type_description}}
                                  </td>
                                  <td>
                                      {{$type->CreatedBy->name}}
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-lg-5 card border">
            <div class="card-header">
                Create new account type
            </div>
            <div class="card-body">
                <form action="{{url('/accounts/type')}}" method="post">
                    @csrf

                    @if (Session::has('success'))
                    <div class="alert alert-success p-1">
                        {{Session::get('success')}}
                    </div>
                    @endif
                    
                    <div class="form-group">
                        <label for="account_type_name">Account Type Name</label>
                        <input type="text" name="account_type" placeholder="Enter account type name" class="form-control"
                        value="{{old('account_type')}}">
                    </div>
                    @error('account_type')
                    <div class="alert alert-danger p-1">
                        {{$message}}
                    </div>
                    @enderror
                    
                    <div class="form-group">
                        <label for="account_type_name">Account Type Description</label>
                        <textarea type="text" name="account_description" placeholder="Enter account type description" 
                        class="form-control">{{old('account_description')}}</textarea>                    
                    </div>

                    @error('account_description')
                    <div class="alert alert-danger p-1">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">{{'Add account type'}}</button>                    
                    </div>
                </form>            
            </div>
        </div>
    </div>
</div>
@endsection
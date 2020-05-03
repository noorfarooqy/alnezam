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
                        <li class="breadcrumb-item"><a href="javaScript:void();">Account</a></li>
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
            <div class="card-header bg-primary text-white">
                List of account types
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Account type</th>
                              <th>Account Email</th>
                              <th>Total Credit</th>
                              <th>Balance</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($accounts as $account)
                              <tr>
                                  <td></td>
                                  <td>
                                      <a href="/accounts/account/{{$account->id}}">{{$account->ac_name}}</a>
                                  </td>
                                  <td>
                                      {{$account->ac_email == null ? "No email" : $account->ac_email}}
                                  </td>
                                  <td>
                                      {{$account->CreatedBy->name}}
                                  </td>
                                  <td>
                                      {{$account->DebitEntries->sum('amount') - $account->CreditEntries->sum('amount')}}
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
                <form action="{{url('/accounts/new')}}" method="post">
                    @csrf

                    @if (Session::has('success'))
                    <div class="alert alert-success p-1">
                        {{Session::get('success')}}
                    </div>
                    @endif
                    
                    <div class="form-group">
                        <label for="account_name">Account Name</label>
                        <input type="text" name="account_name" placeholder="Enter account name" class="form-control"
                        value="{{old('account_name')}}">
                    </div>
                    @error('account_email')
                    <div class="alert alert-danger p-1">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="form-group">
                        <label for="account_email">Account email</label>
                        <input type="email" name="account_email" placeholder="Enter account email" class="form-control"
                        value="{{old('account_email')}}">
                    </div>
                    @error('account_email')
                    <div class="alert alert-danger p-1">
                        {{$message}}
                    </div>
                    @enderror
                    
                    <div class="form-group">
                        <label for="account_type_name">Account Type</label>
                        <select name="account_type" id="" class="select form-control">
                            
                            <option value="-1">Select account type</option>
                            @foreach ($ac_types as $type)
                                @if (old('account_type') == $type->id)
                                <option selected value="{{$type->id}}">{{$type->ac_type_name}}</option>
                                @else
                                <option value="{{$type->id}}">{{$type->ac_type_name}}</option>
                                @endif
                            
                            @endforeach
                            
                        </select>               
                    </div>

                    @error('account_type')
                    <div class="alert alert-danger p-1">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="form-group">
                        <label for="account_type_name">Account Description</label>
                        <textarea type="text" name="account_description" placeholder="Enter account type description" 
                        class="form-control">{{old('account_description')}}</textarea>                    
                    </div>

                    @error('account_description')
                    <div class="alert alert-danger p-1">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">{{'Add account'}}</button>                    
                    </div>
                </form>            
            </div>
        </div>
    </div>
</div>
@endsection
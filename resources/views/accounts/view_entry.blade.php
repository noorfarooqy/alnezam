@extends('layouts.mainlayout')
@section('links')

@endsection

@section('scripts')


@endsection
@section('pageTitle')
{{env('APP_NAME')}} - Accounts Entries
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
                        <li class="breadcrumb-item"><a href="javaScript:void();">Entries</a></li>
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
        <div class="card col-md-11 col-lg-11 border">
            <div class="card-header">
                Recorded entry details #{{$entry->id}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Date</th>
                              <th>Account </th>
                              <th>Description</th>
                              <th>Debit</th>
                              <th>Credit</th>
                              <th> Recorded by</th>
                          </tr>
                      </thead>
                      <tbody>
                              <tr>
                                  <td>
                                      <a href="/entries/{{$entry->id}}">{{$entry->id}}</a>
                                  </td>
                                  <td>
                                      <a href="/entries/dated/{{$entry->updated_at}}">{{$entry->updated_at}}</a>
                                  </td>

                                    <td>
                                        <a href="/accounts/account/{{$entry->ac_debit}}">
                                            {{$entry->DebitAccountInfo->ac_name}}
                                        </a>
                                    </td>

                                    <td>
                                        {{$entry->description}}
                                    </td>
                                  
                                    
                                    <td>
                                        <a href="/entries/{{$entry->id}}">{{$entry->amount}}</a>
                                    </td>

                                    <td> - </td>
                                  
                                  <td>
                                      {{$entry->CreatedBy->name}}
                                  </td>
                              </tr>
                              
                              <tr>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>

                                  <td>
                                      <a href="/accounts/account/{{$entry->ac_credit}}">
                                          {{$entry->CreditAccountInfo->ac_name}}
                                      </a>
                                  </td>
                                
                                  <td>
                                      -
                                  </td>
                                  <td> - </td>
                                  
                                  <td>
                                      <a href="/entries/{{$entry->id}}">{{$entry->amount}}</a>
                                  </td>
                                
                                <td>
                                    {{$entry->CreatedBy->name}}
                                </td>
                            </tr>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
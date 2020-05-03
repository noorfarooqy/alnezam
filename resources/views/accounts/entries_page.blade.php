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
                Record Entries 
            </div>
            <div class="card-body">
                <form action="/accounts/entries/new" method="post">
                    @csrf
                    @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-md-3 col-lg-3">
                            <div class="form-group">
                                <label for="source">From</label>
                                <select name="account_source" id="" class="form-control">
                                    <option value="-1">From account</option>
                                    @foreach ($accounts as $account)
                                        @if (old('account_source') == $account->id)
                                        <option value="{{$account->id}}" selected>{{$account->ac_name}}</option>
                                        @else
                                        <option value="{{$account->id}}">{{$account->ac_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @error('account_source')
                            <div class="alert alert-danger p-1">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <div class="form-group">
                                <label for="source">To</label>
                                <select name="account_destination" id="" class="form-control">
                                    <option value="-1">To account</option>
                                    @foreach ($accounts as $account)
                                        @if (old('account_destination') == $account->id)
                                        <option value="{{$account->id}}" selected>{{$account->ac_name}}</option>
                                        @else
                                        <option value="{{$account->id}}">{{$account->ac_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @error('account_destination')
                            <div class="alert alert-danger p-1">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="source">Amount</label>
                                <input name="transaction_amount" step="0.1" type="number" placeholder="Amount" class="form-control" 
                                value="{{old('transaction_amount')}}">
                            </div>

                            @error('transaction_amount')
                            <div class="alert alert-danger p-1">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-lg-8">
                            <div class="form-group">
                                <label for="transaction_description">Description</label>
                                <input name="transaction_description" type="text" placeholder="Description" 
                                value="{{old('transaction_description')}}" class="form-control">
                            </div>

                            @error('transaction_description')
                            <div class="alert alert-danger p-1">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-2 col-lg-2">
                            <div class="form-group">
                                <label for="button"> <span class="text-white">  Transcation </span> </label>
                                <button type="submit" class="from-control btn btn-primary">Record</button>
                            </div>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        @php
             setlocale(LC_MONETARY, "ar_AE");
        @endphp
        <div class="card col-md-11 col-lg-11 border">
            <div class="card-header bg-primary text-white">
                Journal Entries
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
                          @foreach ($entries as $entry)
                              <tr>
                                  <td>
                                      <a href="/accounts/entries/{{$entry->id}}">{{$entry->id}}</a>
                                  </td>
                                  <td>
                                      <a href="/accounts/entries/dated/{{$entry->updated_at}}">{{$entry->updated_at}}</a>
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
                                        <a href="/accounts/entries/{{$entry->id}}">
                                            {{money_format("%i", $entry->amount)}}
                                        </a>
                                        
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
                                      <a href="/accounts/entries/{{$entry->id}}">
                                        {{money_format("%i", $entry->amount)}}
                                        </a>
                                  </td>
                                
                                <td>
                                    {{$entry->CreatedBy->name}}
                                </td>
                            </tr>
                          @endforeach
                      </tbody>
                      <tfoot>
                          {{-- @if ($entries) --}}
                          Showing   {{$entries->currentPage()}} -  {{$entries->lastPage()}} 
                          {{-- @endif --}}
                          
                      </tfoot>
                    </table>
                </div>
                <ul class="pagination pagination-separate pagination-outline-primary">
                    <li class="page-item"><a class="page-link" href="{{$entries->previousPageUrl()}}">Previous</a></li>
                    @for ($page = 1 ; $page <= $entries->lastPage() ; $page++)
                    <li class="page-item"><a class="page-link" href="?page={{$page}}">{{$page}}</a></li>
                    @endfor
                    
                    <li class="page-item"><a class="page-link" href="{{$entries->nextPageUrl()}}">Next</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
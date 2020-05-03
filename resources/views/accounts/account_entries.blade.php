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
    @php
         setlocale(LC_MONETARY, "ar_AE");
    @endphp
    <div class="row">
        <div class="card col-md-11 col-lg-11 border">
            <div class="card-header bg-primary text-white">
                {{$account->ac_name}} Entries
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Date</th>
                              <th>Account</th>
                              <th>Description</th>
                              <th>Debit</th>
                              <th>Credit</th>
                              <th>Created by</th>
                          </tr>
                      </thead>
                      <tbody>
                          @php
                              $total_debit = 0;
                              $total_credit = 0;
                          @endphp
                          @foreach ($entries as $entry)
                              <tr>
                                  <td>
                                      <a href="/accounts/entries/{{$entry->id}}">{{$entry->id}}</a>
                                  </td>
                                  <td>
                                      <a href="/accounts/entries/dated/{{$entry->id}}">{{$entry->updated_at}}</a>
                                  </td>
                                  @if ($entry->ac_debit == $account->id)
                                    <td>
                                        <a href="/accounts/account/{{$entry->ac_credit}}">
                                            {{$entry->CreditAccountInfo->ac_name}}
                                        </a>
                                    </td>
                                  @else

                                    <td>
                                        <a href="/accounts/account/{{$entry->ac_debit}}">
                                            {{$entry->DebitAccountInfo->ac_name}}
                                        </a>
                                    </td>
                                  @endif
                                  
                                    <td>
                                        {{$entry->description}}
                                    </td>
                                    @if ($account->id == $entry->ac_debit)
                                    <td>
                                        <a href="/accounts/entries/{{$entry->id}}">

                                            {{money_format("%i", $entry->amount)}}
                                        </a>
                                    </td>
                                    @php
                                        $total_debit += $entry->amount;
                                    @endphp
                                    @else
                                    <td> - </td>
                                    @endif 
                                    
                                    @if ($account->id == $entry->ac_credit)
                                    <td>
                                        <a href="/accounts/entries/{{$entry->id}}">
                                            {{money_format("%i", $entry->amount)}}
                                        </a>

                                    @php
                                        $total_credit += $entry->amount;
                                    @endphp
                                    </td>
                                    @else
                                    <td> - </td>
                                    @endif
                                  
                                  <td>
                                      {{$account->CreatedBy->name}}
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                      <tfoot>
                          <tr>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th>Balance</th>
                              <th>
                                {{money_format("%i", $total_debit - $total_credit)}}</th>
                          </tr>
                      </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
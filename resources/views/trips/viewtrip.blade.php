@extends('layouts.mainlayout')
@section('links')
    
  <!--Select Plugins-->
  <link href="/assets/plugins/select2/css/select2.min.css" rel="stylesheet"/>
  <link href="/assets/plugins/bootstrap-switch/bootstrap-switch.min.css" rel="stylesheet">
 
@endsection
@section('scripts')
    
    <!--Select Plugins Js-->
    <script src="/assets/plugins/select2/js/select2.min.js"></script>

    <!--Bootstrap Switch Buttons-->
    <script src="/assets/plugins/bootstrap-switch/bootstrap-switch.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('.single-select').select2();
            $('.client-location').on('change', function(e){
                console.log('new change ',e);
                $('select.client-location').trigger('click')
            })

            $('.client-mark').on('change', function(e){
                console.log('new change ',e);
                $('select.client-mark').trigger('click')
            })

         
          $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
        });
        window.trip_id = "{{$tripdata->id}}";
    </script>

    <script src="/js/tripitems.js"></script>
@endsection
@section('body-content')
<div class="container-fluid">
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
                    <div class="card-body">
                        <div class="row" v-if="Error.visible">
                            <div class="alert alert-danger alert-dismissible" role="alert" style="width:100%">
                                {{-- <button type="button" class="close" data-dismiss="alert">×</button> --}}
                                 <div class="alert-icon">
                                  <i class="fa fa-times"></i>
                                 </div>
                                 <div class="alert-message">
                                   <span><strong>Error!</strong> @{{Error.error_text}}</span>
                                 </div>
                               </div>
                           </div>
                           <div class="row" v-if="Success.visible">
                            <div class="alert alert-success alert-dismissible" role="alert" style="width:100%">
                                {{-- <button type="button" class="close" data-dismiss="alert">×</button> --}}
                                <div class="alert-icon">
                                 <i class="fa fa-check"></i>
                                </div>
                                <div class="alert-message">
                                  <span><strong>Success!</strong> @{{Success.success_text}}</span>
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
                        
                        <form action="">
                            <div class="row">
                                <div class="col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label for="exampleInputUsername" class="sr-only">Item name</label>
                                        <div class="position-relative has-icon-right">
                                            <input type="text" id="exampleInputUsername" v-model="ItemDetails.item_name" class="form-control input-shadow"
                                                placeholder="Enter Item name" >
                                            <div class="form-control-position">
                                                <i class="zmdi zmdi-collection-item"></i>
                                            </div>
                                            @error('trip_name')
                                            <span class="error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    
                                    <div class="form-group">
                                        <label for="exampleInputUsername" class="sr-only">Quantity</label>
                                        <div class="position-relative has-icon-right">
                                            <input type="text" id="exampleInputUsername" v-model="ItemDetails.item_quantity" class="form-control input-shadow"
                                                placeholder="Enter Item quantity" >
                                            <div class="form-control-position">
                                                <i class="fa fa-list-ol"></i>
                                            </div>
                                            @error('item_quantity')
                                            <span class="error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    
                                    <div class="form-group">
                                        <label for="exampleInputUsername" class="sr-only">Price</label>
                                        <div class="position-relative has-icon-right">
                                            <input type="text" id="exampleInputUsername" v-model="ItemDetails.item_price" class="form-control input-shadow"
                                                placeholder="Enter Item price" >
                                            <div class="form-control-position">
                                                <i class="zmdi zmdi-money-box"></i>
                                            </div>
                                            @error('item_price')
                                            <span class="error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <input type="text" disabled :value="totalAED" class="form-control">
                                </div>
                                <div class="col-md-2 col-lg-2">
                                <input type="text" disabled :value="totalUSD" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-lg-3">

                                    <select class="form-control single-select client-mark" name="launch" @click.prevent="SelectedItemClient">
                                        <option value="-1">Select Client Mark</option>
                                        <option v-for="(customer,ckey) in ClientList" :value="customer.id" :key="ckey">
                                            @{{customer.client_mark}}
                                        </option>
                                        
                                    </select>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <input type="text" disabled class="form-control" v-model="ItemDetails.client_name">
                                </div>
                                <div class="col-md-3 col-lg-3 bt-switch">
                                    <input type="checkbox" checked data-on-color="success" v-model="ItemDetails.item_paid" data-off-color="danger" data-on-text="Paid" data-off-text="Unpaid">  
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <button class="btn btn-info" @click.prevent="addItem">
                                        <i class="fa fa-plus-square"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row mb-4 ml-1">
                                *if client doesn't exist <a href="" data-toggle="modal" data-target="#formemodal"> Add new client here </a>
                                @include('clients.newformmodal')
                            </div>
                            
                        </form>
                        <div class="table-responsive">

                            <table id="example" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Item name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total AED</th>
                                        <th>Total USD</th>
                                        <th>Is paid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, ikey) in ItemList.slice().reverse()" >
                                        <td v-text="item.item_name"></td>
                                        <td v-text="item.item_quantity"></td>
                                        <td v-text="item.item_price"></td>
                                        <td v-text="item.item_total_aed"></td>
                                        <td v-text="item.item_total_usd"></td>
                                        <td >
                                            <div class="bt-switch">
                                                <button class="btn btn-success" v-if="item.item_paid" >Paid</button>
                                                <button class="btn btn-danger" v-else >Unpaid</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Item name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total AED</th>
                                        <th>Total USD</th>
                                        <th>Mark as paid</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>TOTAL DIRHAM </th>
                                        <th>
                                             <span v-text="grand_total_aed"></span>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>TOTAL US DOLLAR </th>
                                        <th>
                                             <span v-text="grand_total_usd"></span>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection

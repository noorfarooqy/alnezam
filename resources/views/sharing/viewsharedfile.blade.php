@extends('mail.layout')
@section('links')
<!--Data Tables -->
<link href="/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="/assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
    
@endsection

@section('scripts')


  <!--Data Tables js-->
  <script src="/assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js"></script>
  <script src="/assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
  <script src="/assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js"></script>
  <script src="/assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js"></script>
  <script src="/assets/plugins/bootstrap-datatable/js/jszip.min.js"></script>
  <script src="/assets/plugins/bootstrap-datatable/js/pdfmake.min.js"></script>
  <script src="/assets/plugins/bootstrap-datatable/js/vfs_fonts.js"></script>
  <script src="/assets/plugins/bootstrap-datatable/js/buttons.html5.min.js"></script>
  <script src="/assets/plugins/bootstrap-datatable/js/buttons.print.min.js"></script>
  <script src="/assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js"></script>
<script>
    
    $(document).ready(function() {
     //Default data table
      $('#default-datatable').DataTable();


      var table = $('#example').DataTable( {
       lengthChange: false,
       buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
     } );

    table.buttons().container()
       .appendTo( '#example_wrapper .col-md-6:eq(0)' );
     
     } );

   </script>
   
@endsection
@section('pageTitle')
Al Nezam Al Asasy - {{$tripInfo->trip_name}}
@endsection
@section('mail-body')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-1 col-lg-1"></div>
        <div class="col-md-10 col-lg-10">
             <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">{{$tripInfo->trip_name}}</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">List</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Item</a></li>
            <li class="breadcrumb-item active" aria-current="page"></li>
         </ol>
	   </div>
	   <div class="col-sm-3">
     </div>
     </div>
    <!-- End Breadcrumb-->
            <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> {{$tripInfo->trip_name}}</div>
                    <div class="card-body">
                      <div class="table-responsive">
                      <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Client name</th>
                                <th>Mark</th>
                                <th>Item name</th>
                                <th>Quant</th>
                                <th>Price</th>
                                <th>Balance AED</th>
                                <th>Balance USD</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($itemlist as $item)
                            @php
                                $client_name = $item->clientInfo->client_name;
                                $mark = $item->clientInfo->client_mark;
                            @endphp
                            <tr>
                                <td>
                                    <a href="/clients/{{$item->clientInfo->id}}/trip/{{$item->trip_id}}">
                                        {{$client_name}}
                                    </a>
                                </td>
                                <td>
                                    {{$mark}}
                                </td>
                                <td>
                                    {{$item->item_name}}
                                </td>
                                <td>
                                    {{$item->item_quantity}}
                                </td>
                                <td>
                                    {{$item->item_price}}
                                </td>
                                <td>
                                    {{$item->item_total_aed}}
                                </td>
                                <td>
                                    {{$item->item_total_usd}}
                                </td>
                            </tr>
                            
                                
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Client name</th>
                                <th>Client Mark</th>
                                <th>Item name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Balance AED</th>
                                <th>Balance USD</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>TOTAL DIRHAM </th>
                                <th>
                                    {{$grand_total["grand_aed"]}}
                                </th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>TOTAL US DOLLAR </th>
                                <th>
                                     {{$grand_total["grand_usd"]}}
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
        <div class="col-md-1 col-lg-1"></div>
        
    </div>
</div>
@endsection

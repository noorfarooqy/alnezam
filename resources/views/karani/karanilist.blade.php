@extends('layouts.mainlayout')
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
@section('body-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-1 col-lg-1"></div>
        <div class="col-md-10 col-lg-10">
             <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Karani list</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">List</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Karani</a></li>
            <li class="breadcrumb-item active" aria-current="page"></li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       <div class="btn-group float-sm-right">
        <button type="button" class="btn btn-light waves-effect waves-light"><i class="fa fa-cog mr-1"></i> Setting</button>
        <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown">
        <span class="caret"></span>
        </button>
        <div class="dropdown-menu">
          <a href="javaScript:void();" class="dropdown-item">Action</a>
          <a href="javaScript:void();" class="dropdown-item">Another action</a>
          <a href="javaScript:void();" class="dropdown-item">Something else here</a>
          <div class="dropdown-divider"></div>
          <a href="javaScript:void();" class="dropdown-item">Separated link</a>
        </div>
      </div>
     </div>
     </div>
    <!-- End Breadcrumb-->
            <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> Data Exporting</div>
                    <div class="card-body">
                      <div class="table-responsive">
                      <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Karani name</th>
                                <th>Karani email</th>
                                <th>Karani phone</th>
                                <th>Activity</th>
                                <th>Adde on</th>
                                <th>Services</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($karanilist as $karani)
                            <tr>
                                <td>
                                    {{$karani->karani_name}}
                                </td>
                                <td>
                                    {{$karani->karani_email}}
                                </td>
                                <td>
                                    {{$karani->karani_number}}
                                </td>
                                <td>
                                    {{$karani->is_active == true ? "Active" : "Inactive"}}
                                </td>
                                <td>
                                    {{$karani->created_at}}
                                </td>
                                <td>
                                     0
                                </td>
                            </tr>
                                
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Launch name</th>
                                <th>Owner</th>
                                <th>Captain</th>
                                <th>Activity</th>
                                <th>Adde on</th>
                                <th>Services</th>
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

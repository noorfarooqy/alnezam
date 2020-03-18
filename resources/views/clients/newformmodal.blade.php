<div class="modal fade" id="formemodal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add new client</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form>
               <div class="form-group">
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
                   <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <label for="input-1">Cleint Name *</label>
                            <input type="text" class="form-control" v-model="Client.client_name" placeholder="Enter Client Name">
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <label for="input-2">Client Email</label>
                            <input type="text" class="form-control" v-model="Client.client_email" placeholder="Enter Client Email Address">
                        </div>
                   </div>
                 
               </div>
               <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <label for="input-1">Cleint phone</label>
                            <input type="text" class="form-control" v-model="Client.client_phone" placeholder="Enter Client phone">
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <label for="input-2">Client location *</label>
                            
                            <select  class="form-control single-select client-location" v-model="Client.client_location" @click.prevent="SelectClientLocation($event)">
                                <option value="1">Kismayo</option>
                                <option value="2">Bosaaso</option>
                                <option value="3">Dubai</option>
                                <option value="4">Muqdisho</option>
                            </select>
                        </div>
                </div>
               </div>
               <div class="form-group">
                 <label for="input-3">Client mark *</label>
                 <input type="text" class="form-control" v-model="Client.client_mark" placeholder="Enter Client mark" required>
               </div>
               <div class="form-group">
                <button type="submit" class="btn btn-primary px-5" @click.prevent="AddNewClient()"><i class="icon-plus"></i> Add client</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
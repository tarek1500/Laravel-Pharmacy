@extends('app')
@section('title', 'Addresses')

@section('content')
<div class="container">    
    
     <h1 align="center" class="text-secondary"> Users Addresses</h1>
     <div align="left">
     <a class="btn btn-success" href="{{route('dashboard.addresses.create')}}"name="create_record" id="create_record"><i class="far fa-plus-square"></i> Add new Address</a> 
     </div>
     <br />
<div class="table-responsive">
<table style="width:100%" class="table table-bordered table-striped" id="address_table">

  <thead>
  
    <tr>

      <th scope="col">User ID</th>
      <th scope="col">User Name</th>
      <th scope="col">Area</th>
      <th scope="col">Street Name</th>
      <th scope="col">Building_No</th>
      <th scope="col">Floor_No</th>
      <th scope="col">Flat_No</th>
      <th scope="col">Is Main</th>
      <th scope="col">Action</th>

    </tr>
  </thead>

</table>
</div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h2 align="left" >Confirmation</h2>
                <button align="right" type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div id="cantDeleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h2 align="left" >Cant Delete!</h2>
                <button align="right" type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">it is main address you should select another address to be the main before deleting this address.</h4>
            </div>
            <div class="modal-footer">
            <button align="center" type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
  <script>
$(document).ready(function(){

 $('#address_table').DataTable({
  processing: true,
  serverSide: true,
  ajax:'{{ route('dashboard.addresses.index') }}',

               columns: [

                        { data: 'user_id', name: 'user_id' },
                        { data: 'user_name', name: 'user_name' },
                        { data: 'area_name', name: 'area_name' },
                        { data: 'street_name', name: 'street_name' },
                        { data: 'building_number', name:'building_number' },
                        { data: 'floor_number', name: 'floor_number' },
                        { data: 'flat_number', name: 'flat_number' },
                        { data: 'is_main', name: 'is_main' },
                        {
                          data: 'action',
                          name: 'action',
                          orderable: false
                        },
                     ]
            });
         });

var address_id;
function deleteAddress(a_id)
  {  address_id=a_id;
  $('#confirmModal').modal('show'); 
  }
  $('#ok_button').click(function(){
  $.ajax({
  url:"/dashboard/addresses/"+address_id,
  type:'DELETE',
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
      
  
  success:function(data)
  {
    if(data.errors)
     {
      $('#confirmModal').modal('hide');
      $('#cantDeleteModal').modal('show');
     }
     else
     {
      setTimeout(function(){
      $('#confirmModal').modal('hide');
      $('#address_table').DataTable().ajax.reload();
      }, 2000);
     }
  
  }
 })
});
        </script>
@endsection

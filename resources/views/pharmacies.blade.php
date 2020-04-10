@extends('app')
@section('title', 'Pharmacies')

@section('content')
<div class="container">    
     <div align="left">
     <a class="btn btn-success" href="{{route('dashboard.pharmacies.create')}}"name="create_record" id="create_record"><i class="far fa-plus-square"></i> Add new Pharmacy</a> 
     <a class="btn btn-danger" href="{{route('dashboard.pharmacies.trash')}}"name="Trash" id="Trash"><i class="fas fa-trash-alt"></i>  Trash</a> 

     </div>
     <br />
   <div class="table-responsive">
<table style="width:100%" class="table table-bordered table-striped" id="pharmacy_table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Avatar</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">National_ID</th>
        <th scope="col">Priority</th>
        <th  width="180">Action</th>

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
                <h4 align="center" style="margin:0;">This Pharmacy has Orders</h4>
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

 $('#pharmacy_table').DataTable({
  processing: true,
  serverSide: true,
  ajax:'{{ route('dashboard.pharmacies.index') }}',

               columns: [
                        { data: 'id', name: 'id' },
                        { data: 'avatar_image', name: 'avatar_image' ,
                          render: function(data, type, full, meta){
                           return "<img src=" + data + " alt='avatar' height='42' width='42' />";}},
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'national_id', name: 'national_id' },
                        { data: 'priority', name: 'priority' },
                        {
                          data: 'action',
                          name: 'action',
                          orderable: false
                        },
                     ]
            });
         });
        

var pharmacy_id;
function deletePharmacy(p_id)
  {  pharmacy_id=p_id;
  $('#confirmModal').modal('show'); 
  }
  $('#ok_button').click(function(){
  $.ajax({
  url:"/dashboard/pharmacies/"+pharmacy_id,
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
      $('#pharmacy_table').DataTable().ajax.reload();
      }, 2000);
     }
  
  }
 })
});

</script>
@endsection
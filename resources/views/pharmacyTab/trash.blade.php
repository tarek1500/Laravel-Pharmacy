@extends('app')

@section('content')
<div class="container">    
<div align="left">
<a class="btn btn-success" href="{{route('dashboard.pharmacies.index')}}"name="pharmacies" id="pharmacies">Back to Pharmacies</a> 
</div>
<br>
   <div class="table-responsive">
<table style="width:100%" class="table table-bordered table-striped" id="trash_table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Avatar</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">National_ID</th>
        <th scope="col">Priority</th>
        <th scope="col">restore</th>

      </tr>
    </thead>
   
  </table>
  </div>
  </div>
 
  @endsection
  @section('script')
  <script>
$(document).ready(function(){

 $('#trash_table').DataTable({
  processing: true,
  serverSide: true,
  ajax:'{{ route('dashboard.pharmacies.trash') }}',

               columns: [
                        { data: 'id', name: 'id' },
                        { data: 'avatar_image', name: 'avatar_image' ,
                          render: function(data, type, full, meta){
                           return "<img src=/images/pharmacy_avatar/" + data + " alt='avatar' height='42' width='42' />";}},
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'national_id', name: 'national_id' },
                        { data: 'priority', name: 'priority' },
                        {
                          data: 'restore',
                          name: 'restore',
                          orderable: false
                        },
                     ]
            });
         });
        

var pharmacy_id;
function retrivePharmacy(p_id)
  {  pharmacy_id=p_id;
      $.ajax({
      url:"dashboard/pharmacies/"+pharmacy_id+"/restore",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      
  
  success:function(data)
  {
    
      setTimeout(function(){
      $('#trash_table').DataTable().ajax.reload();
      }, 2000);
     
  
  }
});
  }
</script>
@endsection
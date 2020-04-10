@extends('app')
@section('title', 'Orders')

@section('content')

<div class="container">
    <h2 class = "float-left text-secondary">Orders index page</h2>
    <a href="{{route('dashboard.orders.create')}}" class="btn btn-success btn-lg float-right mr-5"> Create a new order </a>
</div>

<div class="container">
<table class="table table-striped text-center"  id="orders_table" >
    <thead>
      <tr>
        <th scope="col" >ID</th>
        <th scope="col" style="width:50%;">User Name</th>
        <th scope="col" >Delivering Add</th>
        <th scope="col" >Creation Date</th>
        <th scope="col" >Doctor Name</th>
        <th scope="col" >Is Insured</th>
        <th scope="col" >Status</th>
        @if(Auth::guard('admin')->check())
        <th scope="col" >Creator type</th>
        <th  scope="col" >Assigned Pharmacy</th>
        @endif
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody >

    </tbody>
    <tfoot></tfoot>
  </table>
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


</div>
@section('script')
<script>



$(document).ready(function(){

$('#orders_table').DataTable({
 processing: true,
 serverSide: true,
 ajax:'{{ route('dashboard.orders.index') }}',

      columns: [
                {
                  data: 'id',
                  name: 'id'
                },
                {
                  data: 'orderd_user',
                  name: 'orderd_user'
                },
                {
                  data: 'delivering_address',
                  name: 'delivering_address'
                },
                {
                  data: 'created_at',
                  name: 'created_at'
                },
                {
                data :'doctor_name',
                name:'doctor_name'
                },
                {
                  data: 'is_insured',
                  name: 'is_insured'
                },
                {
                data: 'status',
                  name: 'status'
                },
                @if(Auth::guard('admin')->check())
                {
                  data: 'creator_type',
                  name: 'creator_type'
                },
                {
                  data:'pharmacy',
                  name:'pharmacy'
                },
                @endif
                {
                  data: 'action',
                  name: 'action',
                  orderable: false,
                  className:'actionButtons',
                  
                },

            ],
               });
                    });

var order_id;
function deleteOrder(o_id)
  {  order_id=o_id;
  $('#confirmModal').modal('show');
  }
  $('#ok_button').click(function(){
  $.ajax({
  url:"/dashboard/orders/"+order_id,
  type:'DELETE',
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },


  success:function(data)
  {

      setTimeout(function(){
      $('#confirmModal').modal('hide');
      $('#orders_table').DataTable().ajax.reload();
      }, 2000);


  }
 })
});

</script>
@endsection
@endsection

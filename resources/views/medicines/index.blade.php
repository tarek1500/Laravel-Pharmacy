{{-- {{ $medicines }} --}}
@extends('app')
@section('title', 'Medicines')
@section('content')
    <div class="container">
        <table id="medicines_table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
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
    @section('script')
        <script>
            $(document).ready(function(){
                $('#medicines_table_wrapper').removeClass('form-inline')

$('#medicines_table').DataTable({
 processing: true,
 serverSide: true,
 ajax:'{{ route('dashboard.medicines.index') }}',

      columns: [
                {
                  data: 'id',
                  name: 'id'
                },
                {
                  data: 'name',
                  name: 'name'
                },
                {
                  data: 'type',
                  name: 'type'
                },
                {
                  data: 'action',
                  name: 'action',
                  orderable: false,
                  className:'actionButtons',
                  
                }

            ],
               });
                    });

var med_id;
function deleteMedicine(m_id)
  {  med_id=m_id;
  $('#confirmModal').modal('show');
  }
  $('#ok_button').click(function(){
  $.ajax({
  url:"/dashboard/medicines/"+med_id,
  type:'DELETE',
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },


  success:function(data)
  {

      setTimeout(function(){
      $('#confirmModal').modal('hide');
      $('#medicines_table').DataTable().ajax.reload();
      }, 2000);


  }
 })
});
        </script>
    @endsection
@endsection


@extends('app')
@section('title', 'Doctors')

@section('content')
<h2 class="float-left">Doctors Section</h2>
<a class="btn btn-success float-right mr-5" href="{{route('dashboard.doctors.create')}}">Add New Doctor</a>



        <table id="doctor_table" class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Doctor's ID</th>
                <th scope="col">Image</th>
                <th scope="col">name</th>
                @role('admin')
                <th scope="col">Doctor's Branch</th>
                @endrole
                <th scope="col">Ban/UnBan</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
        </table>

{{-- modal for confirm Delete --}}
        <div id="confirmModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h2 align="left" >Confirmation</h2>
                        <button align="right" type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h3 align="center" style="margin:0;">Are you sure you want to remove Doctor?</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" name="ok_button" id="ok" class="btn btn-danger">OK</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

{{-- End Delete zModal --}}

@section('script')

<script>

    $(document).ready(function(){

        $('#doctor_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('dashboard.doctors.index') }}"
            },
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'avatar_image',
                    render: function(data, type, full, meta){
                           return "<img src=" + data + " alt='avatar_image' height='42' width='42' />";},
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'pharmacy_id',
                    name: 'pharmacy_id',
                    orderable:false
                },
                {
                    data: 'is_baned',
                    name: 'is_baned'

                },
                {
                    data: 'action',
                    name: 'action',
                    orderable:false
                },
            ]

        })

    });





var doctor_id;


function banDoctor(d_id){
    doctor_id = d_id;
    // console.log(d_id);
    $('#ban').click(function(){

        
    var state = $('#ban').val();
    

    $.ajax({
    url:"/dashboard/doctors/"+doctor_id,
    method:'PUT',
    data: {state: true},
    dataType: 'json',
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  success:function(data)
  {
    console.log(data);
      $('#doctor_table').DataTable().ajax.reload();
  }
 })


    })

    $('#unban').click(function(){
        console.log(doctor_id);
    })
 }













function deleteDoctor(d_id){
  doctor_id=d_id;
  $('#confirmModal').modal('show');
  }

  $('#ok').click(function(){
    $.ajax({
    url:"/dashboard/doctors/"+doctor_id,
    type:'DELETE',
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },

  success:function(data)
  {
      setTimeout(function(){
      $('#confirmModal').modal('hide');
      $('#doctor_table').DataTable().ajax.reload();
      }, 1000);

  }
 })



});

</script>

@endsection

@endsection

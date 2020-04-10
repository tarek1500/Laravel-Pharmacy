@extends('app')
@section('title', 'Doctors')

@section('content')
<h2 class="float-left">Doctors Section</h2>
<a class="btn btn-success float-right mr-5" href="{{route('dashboard.doctors.create')}}">Add New Doctor</a>

<div class="container">
    <div class="table-responsive">
        <table id="doctor_table" class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Doctor's ID</th>
                <th scope="col">Image</th>
                <th scope="col">Doctor's Branch</th>
                <th width="10%" scope="col">Action</th>
            </tr>
            </thead>
        </table>
    </div>
</div>

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
                    name: 'avatar_image'
                },
                {
                    data: 'pharmacy_id',
                    name: 'pharmacy_id'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable:false
                },
            ]

        })

    });


</script>

@endsection

@endsection

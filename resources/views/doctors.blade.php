@extends('app')
@section('title', 'Doctors')

@section('content')
<h2 class="float-left">Doctors Section</h2>
<a class="btn btn-success float-right mr-5" href="{{route('dashboard.doctors.create')}}">Add New Doctor</a>
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Doctor's ID</th>
        <th scope="col">Doctor's Name</th>
        <th scope="col">Doctor's Branch</th>
        <th width="10%" scope="col">Edit</th>
        <th width="10%" scope="col">Delete</th>

      </tr>
    </thead>
    <tbody>

        @foreach($doctors as $doctor)
            <tr>
                <th scope="row">{{$doctor->id}}</th>
                <td>{{$doctor->name}}</td>
                <td>{{$doctor->pharmacy_id ? $doctor->Pharmacy->name : "NotExist" }}</td>
                <td width="10%"> <a href="" class="btn btn-primary" ><i class="fas fa-edit"></i></a> </td>
                <td width="10%"> <a href="" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></a></td>
            </tr>
        @endforeach

    </tbody>
  </table>
@endsection

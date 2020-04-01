@extends('app')
@section('title', 'Doctors')

@section('content')
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Doctor's ID</th>
        <th scope="col">Doctor's Name</th>
        <th scope="col">Doctor's Branch</th>
        <th width="10%" scope="col">Add</th>
        <th width="10%" scope="col">Edit</th>
        <th width="10%" scope="col">Delete</th>

      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td width="10%"> <a href="" class="btn btn-success" ><i class="far fa-plus-square"></i></a> </td>
        <td width="10%"> <a href="" class="btn btn-primary" ><i class="fas fa-edit"></i></a> </td>
        <td width="10%"> <a href="" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></a></td>

      </tr>

      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td> <a href="" class="btn btn-success" ><i class="far fa-plus-square"></i></a> </td>
        <td> <a href="" class="btn btn-primary" ><i class="fas fa-edit"></i></a> </td>
        <td> <a href="" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></a></td>

      </tr>

      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td> <a href="" class="btn btn-success" ><i class="far fa-plus-square"></i></a> </td>
        <td> <a href="" class="btn btn-primary" ><i class="fas fa-edit"></i></a> </td>
        <td> <a href="" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></a></td>

      </tr>

    </tbody>
  </table>
@endsection
@extends('app')
@section('title', 'Areas')
@section('content')

<h1 class="text-secondary float-left">Areas Section</h1>
<a href="" class="btn btn-success btn-lg float-right mr-5"> Create a New Area </a>
<table class="table table-striped text-center">
  <thead>
    <tr>
      <th scope="col">Area Id</th>
      <th scope="col">Area's Name</th>
      <th scope="col">Area's Address</th>
      <th width="10%" scope="col">Edit</th>
      <th width="10%" scope="col">Delete</th>

    </tr>
  </thead>

  <tbody>
    <tr>
      <td>1</td>
      <td>Branch</td>
      <td>sidibeshr</td>
      <td width="10%"> <a href="" class="btn btn-primary" ><i class="fas fa-edit"></i></a> </td>
      <td width="10%"> <a href="" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></a></td>
    </tr>

  </tbody>
</table>


@endsection

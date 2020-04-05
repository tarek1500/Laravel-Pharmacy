@extends('app')
@section('title', 'Orders')

@section('content')

<h2 class = "float-left text-secondary">Orders index page</h2>

<a href="" class="btn btn-success btn-lg float-right mr-5"> Create a new order </a>

<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Order's User Name</th>
        <th scope="col">Delivering Address</th>
        <th scope="col">Creation Date</th>
        <th scope="col">Doctor Name</th>
        <th scope="col">Is Insured</th>
        <th scope="col">Status</th>
        <th colspan="4" class="text-center pr-5" scope="col">Actions</th>

      </tr>
    </thead>
    <tbody>
    
      <tr>
        <td>1</td>
        <td>Ahmed</td>
        <td>sidi beshr</td>
        <td>1/1/2020</td>
        <td>Abdallah</td>
        <td>yes</td>
        <td>confirmed</td>

        <td> <span title = "Confirm Order"> <a href="" class="btn btn-success " ><i class="fas fa-check-square"></i></a> </span></td>
        <td> <span title = "Edit Order"> <a href="" class="btn btn-primary" ><i class="fas fa-edit"></i></a> </span></td>
        <td> <span title = "Delete Order"> <a href="" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></a> </span> </td>

      </tr>

     
      <tr>
        <td>1</td>
        <td>Mohammed</td>
        <td>sidi Gaber</td>
        <td>1/1/2020</td>
        <td>can be empty</td>
        <td>yes</td>
        <td>confirmed</td>

        <td> <span title = "Delete Order"> <a href="" class="btn btn-success " ><i class="fas fa-check-square"></i></a></span> </td>
        <td> <span title = "Delete Order"> <a href="" class="btn btn-primary" ><i class="fas fa-edit"></i></a></span> </td>
        <td> <span title = "Delete Order"> <a href="" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></a></span></td>

      </tr>

      <tr>
        <td>1</td>
        <td>Ahmed</td>
        <td>sidi beshr</td>
        <td>1/1/2020</td>
        <td>Abdallah</td>
        <td>yes</td>
        <td>confirmed</td>

        <td> <span title = "Delete Order"> <a href="" class="btn btn-success " ><i class="fas fa-check-square"></i></a></span> </td>
        <td> <span title = "Delete Order"> <a href="" class="btn btn-primary" ><i class="fas fa-edit"></i></a> </span></td>
        <td> <span title = "Delete Order"> <a href="" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></a></span></td>
      </tr>

    </tbody>
  </table>

@endsection
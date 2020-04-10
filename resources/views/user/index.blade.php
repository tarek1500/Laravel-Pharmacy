@extends('app')
@section('title', 'Users')

@section('content')

<h1 class="text-secondary"> Users Details</h1>

<table class="table table-striped text-center">
  <thead>
    <tr>
      <th scope="col">User Name</th>
      <th scope="col">User's Email</th>
      <th scope="col">User's gender</th>
      <th scope="col">Data Of Birth</th>
      <th scope="col">Mobile Number</th>
      <th scope="col">National Id</th>
      <th scope="col">Last Login Date</th>
    </tr>
  </thead>

  <tbody>

    @foreach ($users as $user)
    <tr>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->gender}}</td>
        <td>{{$user->date_of_birth}}</td>
        <td>{{$user->mobile_number}}</td>
        <td>{{$user->national_id}}</td>
        <td>{{$user->last_login_date}}</td>

    </tr>


    @endforeach



  </tbody>
</table>

@endsection

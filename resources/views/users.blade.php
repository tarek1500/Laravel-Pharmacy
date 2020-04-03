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
    <tr>
      <td>Ali</td>
      <td>aly@example.com</td>
      <td>sidibeshr</td>
      <td>M</td>
      <td>1/1/1996</td>
      <td>29655665655999</td>
      <td>1/1/2020</td>
    </tr>

    <tr>
      <td>Ali</td>
      <td>aly@example.com</td>
      <td>sidibeshr</td>
      <td>M</td>
      <td>1/1/1996</td>
      <td>29655665655999</td>
      <td>1/1/2020</td>
    </tr>

    <tr>
      <td>Ali</td>
      <td>aly@example.com</td>
      <td>sidibeshr</td>
      <td>M</td>
      <td>1/1/1996</td>
      <td>29655665655999</td>
      <td>1/1/2020</td>
    </tr>
  </tbody>
</table>

@endsection
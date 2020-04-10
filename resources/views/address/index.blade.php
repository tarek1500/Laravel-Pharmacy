@extends('app')
@section('title', 'Addresses')

@section('content')

<h1 class="text-secondary"> Users Addresses</h1>
<table class="table table-striped text-center">
  <thead>
    <tr>
      <th scope="col">User Id</th>
      <th scope="col">User Name</th>
      <th scope="col">Street Name</th>
      <th scope="col">Floor Number</th>
      <th scope="col">Area Id</th>
      <th scope="col">Is Main</th>
    </tr>
  </thead>

  <tbody>

    @foreach ($addresses as $address)
    <tr>
        <td>{{ $address->user_id  }}</td>
        <td>{{ $address->user->name }}</td>
        <td>{{ $address->street_name }}</td>
        <td>{{ $address->floor_number }}</td>
        <td>{{ $address->area_id  }}</td>
        <td>{{ $address->is_main  }}</td>
    </tr>
    @endforeach

  </tbody>
</table>

@endsection

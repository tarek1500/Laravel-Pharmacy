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
    <tr>
      <td>1</td>
      <td>AHmed</td>
      <td>sidibeshr</td>
      <td>14</td>
      <td>20</td>
      <td>Yes</td>
    </tr>

    <tr>
      <td>1</td>
      <td>AHmed</td>
      <td>sidibeshr</td>
      <td>14</td>
      <td>20</td>
      <td>Yes</td>
    </tr>

    <tr>
      <td>1</td>
      <td>AHmed</td>
      <td>sidibeshr</td>
      <td>14</td>
      <td>20</td>
      <td>Yes</td>
    </tr>
  </tbody>
</table>

@endsection
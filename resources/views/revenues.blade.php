@extends('app')
@section('title', 'Revenues')

@section('content')

<div class="card text-center bg-success p-0">
  <div class="card-body p-2">
    <h3>Today's Total Revenue is $2000</h3>
  </div>
</div>


<table class="table">
  <thead>
    <tr>
      <th scope="col">PharmacyAvatar</th>
      <th scope="col">PharmacyName</th>
      <th scope="col">TotalOrders</th>
      <th scope="col">TotalRevenue</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td> <img width="40px" src="/images/logo.png" alt=""></td>
      <td>Elazaby</td>
      <td>50</td>
      <td>2000$</td>
    </tr>
  
  </tbody>
</table>

@endsection
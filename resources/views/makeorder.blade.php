@extends('app')
@section('title', 'Orders')

@section('content')

<h2>Create New Order</h2>
<br>
<form>

<div class="form-group px-5">
    <label for="exampleFormControlSelect1">User</label>
    <select class="form-control mb-4" id="exampleFormControlSelect1">
      <option>Pharmacy</option>
      <option>Doctor</option>
    </select>
  </div>


  <div class="form-group px-5">
    <label for="exampleFormControlInput1">Medicine Name</label>
    <input type="email" class="form-control mb-4" id="exampleFormControlInput1>
  </div>

  <div class="form-group px-5">
    <label for="exampleFormControlInput1">Medicine Type</label>
    <input type="email" class="form-control mb-4" id="exampleFormControlInput1>
  </div>

  <div class="form-group px-5">
    <label for="exampleFormControlInput1">Quantity</label>
    <input type="email" class="form-control mb-4" id="exampleFormControlInput1>
  </div>

  <div class="form-group px-5">
    <label for="exampleFormControlInput1">Price</label>
    <input type="email" class="form-control mb-4" id="exampleFormControlInput1>
  </div>

  <div class="form-group px-5">
    <label for="exampleFormControlInput1">Visa Card Number</label>
    <input type="email" class="form-control mb-4" id="exampleFormControlInput1>
  </div>

  <div class="form-group">
    <button type="submit" class="btn btn-success ">Order</button>
  </div>

</form>



@endsection
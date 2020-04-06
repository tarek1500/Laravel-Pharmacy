@extends('app')
@section('title', 'Orders')

@section('content')

<h2>Create New Order</h2>
<br>
<form method="POST" action="{{route('dashboard.orders.store')}}">
@csrf
<div class="form-group px-5">
    <label for="exampleFormControlSelect1">User</label>
    <select class="form-control mb-4" id="exampleFormControlSelect1" name="order_user_id">
      @foreach ($users as $user)
       <option value="{{$user->id}}">{{$user->name}}</option>
      @endforeach
    </select>
  </div>
  <label class="px-5">Medicines:</label>
  <div class="container px-5 medicineContainer">
    <div class="row medicineRow">
      <div class="col-4">
        <label for="exampleFormControlInput1">Medicine Name</label>
        <input type="text" name="med_name[]" class="form-control mb-4" >
      </div>
      <div class="col-3">
        <label for="">Medicine Type</label>
        <input type="text" name="med_type[]" class="form-control mb-4" >
      </div>
      <div class="col-2">
        <label for="">Quantity</label>
      <input type="number" name="med_quantity[]" class="form-control mb-4" >
      </div>
      <div class="col-2">
        <label for="">Price</label>
      <input type="number" name="med_price[]"class="form-control mb-4" >
      </div>
      <div class="col-1 my-4">
        <button class="btn btn-success" id="addMedBtn" type="button">+</button>

      </div>
    </div>
    
    
  </div>

  <div class="form-group px-5">
    <label for="" >is insured</label>
    <input type="checkbox" name="is_insured" value='1'>
  </div>
  <div class="form-group px-5">
    <label for="exampleFormControlInput1">Statues</label>
    <select name="status_id"  class="form-control">
      @foreach ($statuses as $key =>$value)
      <option value={{$value}} >{{$key}}</option>
      @endforeach

    </select>
  </div>


 

  <div class="form-group">
    <button type="submit" class="btn btn-success ">Order</button>
  </div>

</form>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection
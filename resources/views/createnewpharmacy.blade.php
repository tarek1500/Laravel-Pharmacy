@extends('app')
@section('title', 'new pharmacy')

@section('content')

<h2>Create New Pharmacy</h2>
<br>
<form>

  <div class="form-group px-5">
    <label for="exampleFormControlInput1">Pharmacy ID</label>
    <input type="email" class="form-control mb-4" id="exampleFormControlInput1>
  </div>

  <div class="form-group px-5">
    <label for="exampleFormControlInput1">Pharmacy Priority</label>
    <input type="email" class="form-control mb-4" id="exampleFormControlInput1>
  </div>

  <div class="form-group px-5">
    <label for="exampleFormControlInput1">Pharmacy Name</label>
    <input type="email" class="form-control mb-4" id="exampleFormControlInput1>
  </div>

  <div class="form-group px-5">
    <label for="exampleFormControlInput1">Pharmacy Address</label>
    <input type="email" class="form-control mb-4" id="exampleFormControlInput1>
  </div>

  <div class="form-group">
    <button type="submit" class="btn btn-success ">Create Pharmacy</button>
  </div>

</form>

@endsection
@extends('app')
@section('title', 'Edit Doctor')

@section('content')

<h2>Edit Doctor Info</h2>
<br>
<form action="{{route('dashboard.doctors.update' , $doctor->id)}}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
{{-- name section --}}
    <div class="form-group px-5">
        <label for="name">Doctor Name</label>
    <input id="name" type="text" name="name" value="{{$doctor->name}}" class="form-control mb-4" id="exampleFormControlInput1>
    </div>

    @error('name')
    <div class="form-group px-5">
        <div class="alert alert-danger">{{ $message }}</div>
    </div>
    @enderror
{{-- end of name section --}}

{{-- email section --}}
<div class="form-group px-5">
    <label for="email">Doctor's Email</label>
    <input type="email" name="email" value="{{$doctor->email}}" class="form-control mb-4" id="exampleFormControlInput1>
  </div>

    @error('email')
    <div class="form-group px-5">
        <div class="alert alert-danger">{{ $message }}</div>
    </div>
    @enderror
{{-- end email section --}}

{{-- passwod section --}}
      <div class="form-group px-5">
        <label for="exampleFormControlInput1">Password</label>
        <input type="password" name="password" value="{{$doctor->password}}" class="form-control mb-4" id="exampleFormControlInput1>
      </div>

      @error('password')
      <div class="form-group px-5">
          <div class="alert alert-danger">{{ $message }}</div>
      </div>
      @enderror
{{-- end password  --}}

{{-- id section --}}
      <div class="form-group px-5">
        <label for="exampleFormControlInput1">National Id</label>
        <input type="number" name="national_id" value="{{$doctor->national_id}}" class="form-control mb-4" id="exampleFormControlInput1>
      </div>

      @error('national_id')
      <div class="form-group px-5">
          <div class="alert alert-danger">{{ $message }}</div>
      </div>
      @enderror
{{-- end id section  --}}

{{-- image section --}}
      <div class="form-group px-5">
        <label for="image">Doctor's Image</label>
        <img src="{{$doctor->avatar_image}}" width="50px" height="50px">
        <input name="image" type="file" value="" class="form-control-file" id="image">
      </div>

      @error('image')
      <div class="form-group px-5">
          <div class="alert alert-danger">{{ $message }}</div>
      </div>
      @enderror
{{-- end image section --}}


    <div class="form-group px-5">
        <label for="exampleFormControlSelect1">Pharmacy</label>
        <select  name="pharmacy_name" class="form-control" id="exampleFormControlSelect1">

                <option> {{$doctor->pharmacy_id ? $doctor->Pharmacy->name : "NotExist" }} </option>

        </select>
    </div>


    <div class="form-group px-5">
        <button type="submit" class="btn btn-success ">Update Doctor's Data</button>
    </div>

</form>

@endsection

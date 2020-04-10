@extends('app')
@section('title', 'New Doctor')

@section('content')

<h2>Add New Doctor</h2>
<br>
<form action="{{route('dashboard.doctors.store')}}" method="POST" enctype="multipart/form-data">
@csrf
{{-- name section --}}
    <div class="form-group px-5">
        <label for="name">Doctor Name</label>
        <input id="name" type="text" name="name" class="form-control mb-4" id="name">
    </div>

    @error('name')
    <div class="form-group px-5">
        <div class="alert alert-danger">{{ $message }}</div>
    </div>
    @enderror
{{-- end of name section --}}

{{-- email section --}}
    <div class="form-group px-5">
        <label for="exampleFormControlInput1">Doctor's Email</label>
        <input type="email" placeholder = "Enter Email" name="email" class="form-control mb-4" id="email">
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
        <input type="password" name="password" class="form-control mb-4" id="Password">
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
        <input type="number" name="national_id" class="form-control mb-4" id="Id">
      </div>

      @error('national_id')
      <div class="form-group px-5">
          <div class="alert alert-danger">{{ $message }}</div>
      </div>
      @enderror
{{-- end id section  --}}

{{-- image section --}}
      <div class="form-group px-5">
        <label for="avatar_image">Doctor's Image</label>
        <input name="avatar_image" type="file" class="form-control-file" id="avatar_image">
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
            @foreach($pharmacies as $pharmacy)
                <option> {{$pharmacy->name}} </option>
            @endforeach
        </select>
    </div>


    <div class="form-group px-5">
        <button type="submit" class="btn btn-success ">Add Doctor</button>
    </div>

</form>

@endsection

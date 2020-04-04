@extends('app')
@section('title', 'New Doctor')

@section('content')

<h2>Add New Doctor</h2>
<br>
<form action="{{route('dashboard.doctors.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    {{-- name section --}}
    <div class="form-group px-5">
        <label for="exampleFormControlInput1">Doctor Name</label>
        <input type="text" name="name" class="form-control mb-4" id="exampleFormControlInput1>

        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    </div>

    {{-- end of name section --}}

    <div class="form-group px-5">
        <label for="exampleFormControlInput1">Doctor's Email</label>
        <input type="email" name="email" class="form-control mb-4" id="exampleFormControlInput1>
      </div>
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

      <div class="form-group px-5">
        <label for="exampleFormControlInput1">Password</label>
        <input type="password" name="password" class="form-control mb-4" id="exampleFormControlInput1>
      </div>

      <div class="form-group px-5">
        <label for="exampleFormControlInput1">National Id</label>
        <input type="password" name="password" class="form-control mb-4" id="exampleFormControlInput1>
      </div>

      <div class="form-group px-5">
        <label for="exampleFormControlFile1">Doctor's Image</label>
        <input type="file" class="form-control-file" id="exampleFormControlFile1">
      </div>



    <div class="form-group px-5">
        <label for="exampleFormControlSelect1">Pharmacy</label>
        <select class="form-control" id="exampleFormControlSelect1">
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

@extends('app')


@section('content')

<h2>Edit profile Info</h2>
<br>
<form action="{{route('dashboard.profile.update' , $user->id)}}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
{{-- name section --}}
    <div class="form-group px-5">
        <label for="name">Name</label>
    <input id="name" type="text" name="name" value="{{$user->name}}" class="form-control mb-4" id="">
    </div>

    @error('name')
    <div class="form-group px-5">
        <div class="alert alert-danger">{{ $message }}</div>
    </div>
    @enderror
{{-- end of name section --}}


{{-- image section --}}
      <div class="form-group px-5">
        <label for="avatar_image">Image</label>
        <input name="avatar_image" type="file" value="<img width="50 px" height="50 px" class="form-control-file" id="image">
      </div>

      @error('image')
      <div class="form-group px-5">
          <div class="alert alert-danger">{{ $message }}</div>
      </div>
      @enderror
{{-- end image section --}}

    <div class="form-group px-5">
        <button type="submit" class="btn btn-success ">Update Data</button>
    </div>

</form>

@endsection

@extends('app')
@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row">
      <div class="mx-auto my-3"><h1 class="text-secondary">
      <form method="post" action="{{route('admin.logout')}}">
      @csrf
          <input class="btn btn-warning" type="submit" value="logout">
      </form>
      </h1> </div>
        <img class="mx-auto" style="width: 700px;" src="./images/logo.png">
    </div>
  </div>
@endsection
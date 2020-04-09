@extends('app')
@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row">
      <div class="mx-auto my-3"><h1 class="text-secondary">
      @role('admin','admin')
      <form method="post" action="{{route('admin.logout')}}">
      @else
        @role('pharmacy','pharmacy')
           <form method="post" action="{{route('pharmacy.logout')}}">
        @else
            <form method="post" action="{{route('doctor.logout')}}">
        @endrole
      @endrole
      @csrf
          <input class="btn btn-warning" type="submit" value="logout">
      </form>
      </h1>   
      </div>
        <img class="mx-auto" style="width: 700px;" src="./images/logo.png">
    </div>
  </div>
@endsection
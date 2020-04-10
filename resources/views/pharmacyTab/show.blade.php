@extends('app')

@section('content')


<div class="container">
  <div class="card" style="width:80%">
  <h2 align="center">{{$pharmacy->name}} Pharmacy</h2>

    <img class="card-img-top" src="/images/pharmacy_avatar/{{$pharmacy->avatar_image}}" alt="Card image" style="width:100%">
    <div class="card-body">
      <label for="email">Email: </label>
      <p>{{$pharmacy->email}}</p>
      <label for="n_id">National_ID:</label>
      <p>{{$pharmacy->national_id}}</p>
      <label for="priority">Priority: </label>
      <p>{{$pharmacy->priority}}</p>
      <label for="area">Area: </label>
      <p>{{$pharmacy->area->name}}</p>
       <p><i class="fa fa-calendar"></i> created_at {{$pharmacy->created_at->format('d M Y')}}</p>
        <p><i class="fa fa-calendar"></i> updated_at {{$pharmacy->updated_at->format('d M Y')}}</p>    </div>
        <a href="{{route('dashboard.pharmacies.edit',['pharmacy'=>$pharmacy->id])}}" class="btn btn-success">Edit Pharmacy</a>
  </div>


@endsection
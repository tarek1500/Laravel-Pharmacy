@extends('app')

@section('content')
	<div class="container">
		<div class="card" style="width:80%">
			<h2 align="center">Area</h2>
			<div class="card-body">
				<label for="">Name:</label>
				<p>{{$area->name}}</p>
				<label for="">Address:</label>
				<p>{{$area->address}}</p>
				<p><i class="fa fa-calendar"></i> Created at: {{$area->created_at->format('d M Y')}}</p>
				<p><i class="fa fa-calendar"></i> Updated at: {{$area->updated_at->format('d M Y')}}</p>
			</div>
			<a href="{{route('dashboard.areas.edit',['area'=>$area->id])}}" class="btn btn-success">Edit Area</a>
		</div>
	</div>
@endsection
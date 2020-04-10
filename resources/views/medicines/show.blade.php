@extends('app')

@section('content')
	<div class="container">
		<div class="card" style="width:80%">
			<h2 align="center">Medicine</h2>
			<div class="card-body">
				<label for="">Name:</label>
				<p>{{$medicine->name}}</p>
				<label for="">Type:</label>
				<p>{{$medicine->type}}</p>
				<p><i class="fa fa-calendar"></i> Created at: {{$medicine->created_at->format('d M Y')}}</p>
				<p><i class="fa fa-calendar"></i> Updated at: {{$medicine->updated_at->format('d M Y')}}</p>
			</div>
			<a href="{{route('dashboard.medicines.edit',['medicine'=>$medicine->id])}}" class="btn btn-success">Edit Profile</a>
		</div>
	</div>
@endsection
@extends ("app")

@section('content')
	<div class="col-md-8 order-md-1">
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<h4 class="mb-3">Add Area Form</h4>
		<form method="POST" action="{{route('dashboard.areas.store')}}">
			@csrf
			<div class="mb-3">
				<label for="name">Name</label>
				<input type="text" class="form-control" id="name" placeholder="" value="" name="name">
			</div>
			<div class="mb-3">
				<label for="address">Address</label>
				<input type="text" class="form-control" id="address" placeholder="" value="" name="address">
			</div>
			<hr class="mb-4">
			<button class="btn btn-primary btn-lg btn-block" type="submit">Save</button>
		</form>
	</div>
@endsection
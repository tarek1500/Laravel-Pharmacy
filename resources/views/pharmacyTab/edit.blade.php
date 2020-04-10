@extends ("app");
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
      <h4 class="mb-3">Edit Pharmacy Form</h4>
      <form method="POST" action="{{route('dashboard.pharmacies.update',['pharmacy'=>$pharmacy->id])}}"  enctype="multipart/form-data">
	  @method('PATCH')
	  @csrf
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="Name">Name</label>
            <input type="text" class="form-control" id="Name" placeholder="" value="{{$pharmacy->name}}" name="name" >
          </div>
        </div>

        <div class="mb-3">
          <label for="email">Email</label>
          <div class="input-group">
          <input type="email" class="form-control" id="email" placeholder="" value="{{$pharmacy->email}}" name="email" >
          </div>
        </div>

        <div class="mb-3">
          <label for="password">Password</label>
          <div class="input-group">
          <input type="password" class="form-control" id="pass" placeholder="" value="{{$pharmacy->password}}" name="password" >
          </div>
        </div>

        <div class="mb-3">
          <label for="n_id">National_ID</label>
          <div class="input-group">
          <input type="text" class="form-control" id="n_id" placeholder="" value="{{$pharmacy->national_id}}" name="national_id" >
          </div>
        </div>

        <div class="mb-3">
          <label for="avatar">Avatar</label>
		  <br>
		  <img src="/images/pharmacy_avatar/{{$pharmacy->avatar_image}}" alt="avatar" height="42" width="42"/>
          <br>
		  <div class="input-group">
          <input type="file"  value="" name="avatar_image" >
          </div>
        </div>
      
          <div class="mb-3">
            <label for="state">Area</label>
            <select name="area_id" class="custom-select d-block w-100" id="state">
			<option value="{{$pharmacy->area->id}}" >{{$pharmacy->area->name}}</option>
          	@foreach ($areas as $area)
              <option value="{{$area->id}}" >{{$area->name}}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
          <label for="priority">Priority: </label>
          <b><output name="priorityOutputName" id="priorityOutputId" >{{$pharmacy->priority}}</output></b>
          <div class="input-group">
          <input type="range" class="form-control" min="1" max="10" id="priorityInputId" placeholder="" value="{{$pharmacy->priority}}" name="priority" oninput="priorityOutputId.value = priorityInputId.value" >
          </div>
        </div>


   
		  <input type="hidden" name="_method" value="PATCH" />

        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">save</button>
		<br>
		<a class="btn btn-lg btn-block btn-success" href="{{route('dashboard.pharmacies.index')}}">Cancel</a>
      </form>
    </div>
  </div>


 @endsection



    		       
    		    

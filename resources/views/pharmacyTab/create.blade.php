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
      <h4 class="mb-3">Add Pharmacy Form</h4>
      <form method="POST" action="{{route('dashboard.pharmacies.store')}}"  enctype="multipart/form-data">
      @csrf
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="Name">Name</label>
            <input type="text" class="form-control" id="Name" placeholder="" value="" name="name" >
          </div>
        </div>

        <div class="mb-3">
          <label for="email">Email</label>
          <div class="input-group">
          <input type="email" class="form-control" id="email" placeholder="" value="" name="email" >
          </div>
        </div>

        <div class="mb-3">
          <label for="password">Password</label>
          <div class="input-group">
          <input type="password" class="form-control" id="pass" placeholder="" value="" name="password" >
          </div>
        </div>

        <div class="mb-3">
          <label for="n_id">National_ID</label>
          <div class="input-group">
          <input type="text" class="form-control" id="n_id" placeholder="" value="" name="national_id" >
          </div>
        </div>

        <div class="mb-3">
          <label for="priority">Priority: </label>
          <b><output name="priorityOutputName" id="priorityOutputId" ></output></b>
          <div class="input-group">
          <input type="range" class="form-control" min="1" max="10" id="priorityInputId" placeholder="" value="" name="priority" oninput="priorityOutputId.value = priorityInputId.value" >
          </div>
        </div>
   
        <div class="mb-3">
          <label for="avatar">Avatar</label>
          <div class="input-group">
          <input type="file"  value="" name="avatar_image" >
          </div>
        </div>
      

          <div class="mb-3">
            <label for="state">Area</label>
            <select name="area_id" class="custom-select d-block w-100" id="state">
              @foreach ($areas as $area)
              <option value="{{$area->id}}" >{{$area->name}}</option>
              @endforeach
            </select>
          </div>
         
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">save</button>
      </form>
    </div>
  </div>



 @endsection

@extends ("app");
 @section('content')
 <div class="col-md-8 order-md-1">

      <h4 class="mb-3">Add Address Form</h4>
      <form method="POST" action="{{route('dashboard.addresses.store')}}"  enctype="multipart/form-data">
      @csrf
      @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Auth::guard('admin')->check())
        <div class="mb-3">
            <label for="state">User</label>
            <select name="user_id" class="custom-select d-block w-100" id="user">
              @foreach ($users as $user)
              <option value="{{$user->id}}" >{{$user->name}}</option>
              @endforeach
            </select>
          </div>
    @endif   
    
    @if(Auth::guard('user')->check())
    <input type="hidden" id="user_id" name ="user_id" value="{{$id}}">
    @endif 

        <div class="mb-3">
            <label for="state">Area</label>
            <select name="area_id" class="custom-select d-block w-100" id="state">
              @foreach ($areas as $area)
              <option value="{{$area->id}}" >{{$area->name}}</option>
              @endforeach
            </select>
          </div>
         

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="Name">street_name</label>
            <input type="text" class="form-control" id="Name" placeholder="" value="" name="street_name" >
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="building_number">building_number</label>
            <input type="text" class="form-control" id="building_number" placeholder="" value="" name="building_number" >
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="floor_number">floor_number</label>
            <input type="text" class="form-control" id="floor_number" placeholder="" value="" name="floor_number" >
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="flat_number">flat_number</label>
            <input type="text" class="form-control" id="flat_number" placeholder="" value="" name="flat_number" >
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
          <label for="is_main">is_main</label><br>
        <input type="radio" id="yes" name="is_main" value="1">
        <label for="yes">Yes</label>
        <input type="radio" id="no" name="is_main" value="0">
        <label for="no">No</label><br>
        </div>
        </div>
        

        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">save</button>
      </form>
    </div>
  </div>



 @endsection

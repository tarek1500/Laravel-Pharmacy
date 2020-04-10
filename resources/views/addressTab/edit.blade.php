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
      <h4 class="mb-3">Edit Address Form</h4>
      <form method="POST" action="{{route('dashboard.addresses.update',['address'=>$address->id])}}"  enctype="multipart/form-data">
	  @method('PATCH')
	  @csrf
    <div class="mb-3">
    
            <label for="user"  >User : {{$address->user->name}}</label>
            <input type="hidden" id="user_id" name ="user_id" value="{{$address->user->id}}">

  </div>
        
        <div class="mb-3">
            <label for="state">Area</label>
            <select name="area_id" class="custom-select d-block w-100" id="state">
            <option value="{{$address->area->id}}" >{{$address->area->name}}</option>
              @foreach ($areas as $area)
              <option value="{{$area->id}}" >{{$area->name}}</option>
              @endforeach
            </select>
          </div>
         

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="Name">street_name</label>
            <input type="text" class="form-control" id="Name" placeholder="" value="{{$address->street_name}}" name="street_name" >
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="building_number">building_number</label>
            <input type="text" class="form-control" id="building_number" placeholder="" value="{{$address->building_number}}" name="building_number" >
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="floor_number">floor_number</label>
            <input type="text" class="form-control" id="floor_number" placeholder="" value="{{$address->floor_number}}" name="floor_number" >
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="flat_number">flat_number</label>
            <input type="text" class="form-control" id="flat_number" placeholder="" value="{{$address->flat_number}}" name="flat_number" >
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
          <label for="is_main">is_main:</label><br>
         @if($address->is_main==1)
        <input type="radio" id="yes" name="is_main" value="1" checked>
        <label for="yes">Yes</label>
        @else
        <input type="radio" id="yes" name="is_main" value="1">
        <label for="yes">Yes</label>
        <input type="radio" id="no" name="is_main" value="0" checked>
        <label for="no">No</label><br>
        @endif
        </div>
        </div>
        

        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">save</button>
      </form>
    </div>
  </div>



 @endsection




    		       
    		    

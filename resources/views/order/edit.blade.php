@extends('app')
@section('title', 'Orders')

@section('content')

<h2>Edit Order #{{$order->id}}</h2>
<br>
<div id="prescriptionsSlider" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    @if (count($order->prescriptions)>0)
      @foreach ($order->prescriptions as $key=>$prescription)
      <div class="carousel-item {{ $key==0 ? 'active' : ''}}">
        <img src="/img.jpg" class="d-block  mx-auto img-fluid" alt="...">
      </div>
      @endforeach
    </div>
    <a class="carousel-control-prev" href="#prescriptionsSlider" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next " href="#prescriptionsSlider" role="button" data-slide="next">
      <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  @else
  <h1 class="text-danger text-center">no prescriptions for this order</h1>
@endif
<form method="POST" action="{{route('dashboard.orders.update',['order'=>$order->id])}}">
@csrf
@method('PUT')
<div class="form-group px-5">
    <label for="exampleFormControlSelect1">User</label>
    <select class="form-control mb-4" id="userSelect" name="order_user_id">
      <option ></option>
      @foreach ($users as $user)
     <option value="{{$user->id}}" @if($order->order_user_id == $user->id){{'selected'}}@endif>{{$user->name}}</option>
      @endforeach
    </select>
  </div>
  
  <label class="px-5">Medicines:</label>
  <div class="container px-5 medicineContainer">
    @foreach ($order->medicines as $order_medicine)
    <div class="row medicineRow">
      <div class="col-4 medicineNameContainer">
        <label for="exampleFormControlInput1">Medicine Name</label>
        <select name="med_name[]" class="form-control mb-4 medicineNameSelect">
          @foreach ($medicines as $medicine)
          <option ></option>
           <option value="{{$medicine->name}}" @if($medicine->id==$order_medicine->id){{'selected'}}@endif>{{$medicine->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="col-3 " class='medTypeContainer'>
        <label for="">Medicine Type</label>
        <select name="med_type[]"  class="form-control mb-4 medicineTypeSelect">
          <option ></option>
          @foreach ($medicines as $medicine)
           <option value="{{$medicine->type}}" @if($medicine->type==$order_medicine->type){{'selected'}}@endif>{{$medicine->type}}</option>
          @endforeach
        </select>
      </div>
      <div class="col-2 medQuanityContainer">
        <label for="">Quantity</label>
      <input type="number" name="med_quantity[]" value="{{$order_medicine->pivot->quantity}}"class="form-control mb-4 quantity" >
      </div>
      <div class="col-2 medPriceContainer">
        <label for="">Price</label>
      <input type="number" name="med_price[]"class="form-control mb-4 price"  value="{{$order_medicine->pivot->price/100}}">
      </div>
      <div class="col-1 my-4 addMedBtnContainer">
        <button class="btn btn-success add"  type="button">+</button>
        <button class="btn btn-danger delete" type='button'>X</button>
      </div>
    </div>
    @endforeach
    
    
  </div>

  <div class="form-group px-5">
    <label for="" >is insured</label>
    <input type="checkbox" name="is_insured" value='1' @if($order->is_insured){{'checked'}}@endif>
  </div>
  <div class="form-group px-5">
    <label for="exampleFormControlInput1">Statues</label>
    <select name="status_id"  class="form-control" >
      
      @foreach ($statuses as $key =>$value)
      <option value={{$key}} @if($key==$order->status_id){{'selected'}}@endif>{{$value}}</option>
      @endforeach

    </select>
  </div>

  <div class="form-group text-center">
    <button type="submit" class="btn btn-success d-block mx-auto" style="width:80%;">Save</button>
    <a href="{{route('dashboard.orders.index')}}" class="btn btn-secondary d-block mx-auto mt-1" style="width:80%;">Cancel</a>
  </div>
</form>
<div class="container">
  <div class="row text-right">
    <div class="col">
      <p>Total Price: <span id="totalPrice"></span></p>
    </div>
  </div>
</div>

<select name="med_name[]" class="form-control mb-4 medData d-none">
  <option ></option>
  @foreach ($medicines as $medicine)
   <option value="{{$medicine->name}}">{{$medicine->name}}</option>
  @endforeach
</select>

<select name="med_type[]" class="form-control mb-4 typeData d-none">
  <option ></option>
  @foreach ($medicines as $medicine)
   <option value="{{$medicine->type}}">{{$medicine->type}}</option>
  @endforeach
</select>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection
@section('script')
     <!-- Select2 -->
     <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
     <!-- medicine creation form -->
   <script src="{{ asset('js/medicine.js')}}"></script>
@endsection
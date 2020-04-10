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
        <img src="{{$prescription->image}}" class="d-block  mx-auto img-fluid" alt="...">
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
    
    <p><label for="exampleFormControlSelect1">User : </label> {{$order->user->name}}</p>
    <label for=""> Delivering Address :</label>
      <ul>
          <li><span>Flat number: </span>{{$order->address->flat_number}}</li>
          <li><span>Floor number: </span>{{$order->address->floor_number}}</li>
          <li><span>Building number: </span>{{$order->address->building_number}}</li>
          <li><span>Street: </span>{{$order->address->street_name}}</li>
          <li><span>Area: </span>{{$order->address->area->name .','.$order->address->area->address}} </li>
      </ul>
  </div>
  
  <label class="px-4">Medicines:</label>
  <div class="container px-5 medicineContainer">
    @foreach ($order->medicines as $order_medicine)
    <div class="row medicineRow">
      <div class="col-4 medicineNameContainer">
        <label for="exampleFormControlInput1">Medicine Name</label>
        <select name="med_name[]" class="form-control mb-4 medicineNameSelect" {{$order->status_id >1? 'disabled' : ''}}>
          @foreach ($medicines_unique_names as $medicines_unique_name)
          <option ></option>
           <option value="{{$medicines_unique_name->name}}" @if($medicines_unique_name->name==$order_medicine->name){{'selected'}}@endif>{{$medicines_unique_name->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="col-3 " class='medTypeContainer'>
        <label for="">Medicine Type</label>
        <select name="med_type[]"  class="form-control mb-4 medicineTypeSelect"  {{$order->status_id >1? 'disabled' : ''}}>
          <option ></option>
          @foreach ($medicines_unique_types as $medicines_unique_type)
           <option value="{{$medicines_unique_type->type}}" @if($medicines_unique_type->type==$order_medicine->type){{'selected'}}@endif>{{$medicines_unique_type->type}}</option>
          @endforeach
        </select>
      </div>
      <div class="col-2 medQuanityContainer">
        <label for="">Quantity</label>
      <input type="number" name="med_quantity[]" value="{{$order_medicine->pivot->quantity}}"class="form-control mb-4 quantity"  {{$order->status_id >1? 'disabled' : ''}}>
      </div>
      <div class="col-2 medPriceContainer">
        <label for="">Price</label>
      <input type="number" name="med_price[]"class="form-control mb-4 price"  value="{{$order_medicine->pivot->price/100}}"  {{$order->status_id >1? 'disabled' : ''}}>
      </div>
      @if( $order->status_id <2)
      <div class="col-1 my-4 addMedBtnContainer">
        <button class="btn btn-success add"  type="button">+</button>
        <button class="btn btn-danger delete" type='button'>X</button>
      </div>
      @endif
    </div>
    @endforeach
    
    
  </div>

  <div class="form-group px-5">
    <label for="" >is insured</label>
    <input type="checkbox" name="is_insured" value='1' @if($order->is_insured){{'checked'}}@endif>
  </div>
  <div class="form-group px-5">
    <label for="exampleFormControlInput1">Statues</label>
    <select id="status-select" name="status_id"  class="form-control" >
      
      @foreach ($statuses as $key =>$value)
        @if($key>= $order->status_id)
       <option value={{$key}} @if($key==$order->status_id){{'selected'}}@endif>{{$value}}</option>
        @endif
       @endforeach

    </select>
  </div>

@if ($order->status_id == 0 || $order->status_id == 1)
	<div class="form-group px-5">
		<label for="">Card holder</label>
		<input type="text" id="card-holder-name" class="form-control">
	</div>
	<div class="form-group px-5">
		<div id="card-element"></div>
	</div>
@endif

  <div class="form-group text-center">
    @if ($order->status_id == 0 || $order->status_id == 1)
      <button id="card-button" class="btn btn-info d-block mx-auto mb-1" style="width:80%;" data-secret="{{ $intent->client_secret }}">Charge</button>
    @endif
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
  @foreach ($medicines_unique_names as $medicines_unique_name)
   <option value="{{$medicines_unique_name->name}}">{{$medicines_unique_name->name}}</option>
  @endforeach
</select>

<select name="med_type[]" class="form-control mb-4 typeData d-none">
  <option ></option>
  @foreach ($medicines_unique_types as $medicines_unique_type)
   <option value="{{$medicines_unique_type->type}}">{{$medicines_unique_type->type}}</option>
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

<div id="transaction-alert" class="d-none alert alert-info">
	<ul>
		<li>Transaction is successed</li>
	</ul>
</div>

@endsection
@section('script')
     <!-- Select2 -->
     <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
     <!-- medicine creation form -->
   <script src="{{ asset('js/medicine.js')}}"></script>

	<script src="https://js.stripe.com/v3/"></script>
	<script>
		window.addEventListener('load', function() {
			if (document.querySelector('#card-element')) {
				const stripe = Stripe('{{ env('STRIPE_KEY') }}');

				const elements = stripe.elements();
				const cardElement = elements.create('card');
				cardElement.mount('#card-element');

				const cardHolderName = document.getElementById('card-holder-name');
				const cardButton = document.getElementById('card-button');
				const clientSecret = cardButton.dataset.secret;

				cardButton.addEventListener('click', async (e) => {
					e.preventDefault();
					const totalPrice = document.querySelector('#totalPrice');
					const amount = +totalPrice.innerText.slice(0, -2);

					if (amount > 0) {
						const { setupIntent, error } = await stripe.confirmCardSetup(clientSecret, {
							payment_method: {
								card: cardElement,
								billing_details: { name: cardHolderName.value }
							}
						});

						if (error) { }
						else {
							fetch('{{ route('dashboard.payment.charge') }}', {
								headers: {
									'Content-Type': 'application/json',
									'X-CSRF-TOKEN': '{{ csrf_token() }}'
								},
								method: 'POST',
								body: JSON.stringify({
									payment_method: setupIntent.payment_method,
									amount: amount,
									name: '{{ $order->user->name }}'
								})
							}).then(function (result) {
								document.querySelector('#transaction-alert').classList.remove('d-none');
								document.querySelector('#status-select').value = 4;
								let chargeButton = document.querySelector('#card-button')
								chargeButton.innerHTML = 'Paid';
								chargeButton.disabled = true;
							}).catch(function (error) {});
						}
					}
				});
			}
		});
	</script>
@endsection
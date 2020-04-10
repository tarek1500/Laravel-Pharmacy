@extends('app')

@section('title')
    Order Details
@endsection
@section('content')
<div class="container">
    <h2>Show Order #{{$order->id}}</h2>
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
  <h1 class="text-danger text-center">No Prescriptions For This order</h1>
@endif
<div class="row justify-content-center">
    <div class="col-6">
        <div class="card mx-auto">
            <div class="card-header bg-dark text-white">
                <h2 align="center"> Order Details </h2>
            </div>
      
          <div class="card-body order_details table-bordered">
              <div class="table-responsive ">
                <label for=""><i class="fas fa-capsules"></i> Medicines :</label>
                <table class="table table-striped text-center table-hover" >
                    <thead class="thead-light">
                        <th>Name</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </thead>
                    <tbody >
                        @foreach ($order->completeMedicines as $medicine)
                        <tr>
                            <td>{{$medicine->name}} </td>
                            <td>{{$medicine->type}} </td>
                            <td>{{$medicine->quantity}}  </td>
                            <td>{{$medicine->price/100}}  $</td>
                        </tr>
                        @endforeach
                        <tr class="bg-secondary">
                            <td colspan="3" >Total Price</td>
                            <td>{{$order->total_price/100}} $  </td>
                        </tr>
                    </tbody>
                </table>
              </div>
            @if(Auth::guard('admin')->check())
              <p><i class="fas fa-clinic-medical"></i> <span> Assigned Pharmacy:</span>  {{$order->pharmacy? $order->pharmacy->name.' , '.$order->pharmacy->address : 'none'}}</p>
              <p><i class="fas fa-user-edit"></i> <span>Creator Type:</span>  {{$order->creator_type}}</p>
              @endif
              <p><i class="fas fa-user-md"></i> <span>Doctor: </span>  {{$order->doctor? $order->doctor->name : 'none'}}</p>
              <p><i class="fas fa-user"></i> <span>Ordered user:</span>  {{$order->user->name}}</p>
              <p><i class="far fa-address-card"></i><span> Is insured:</span>  {{$order->is_insured ? 'yes' : 'no'}}</p>
              <p><i class="fas fa-thermometer-empty"></i> <span>Status:</span>  {{$order->completeStatus}}
                <a href="{{route('dashboard.orders.edit',['order'=>$order->id])}}"> <i class="fas fa-edit text-danger"></i> </a>
              </p>
              <label for=""><i class="fas fa-map-marked-alt"></i> Delivering Address :</label>
              <ul>
                  <li><span>Flat number: </span>{{$order->address->flat_number}}</li>
                  <li><span>Floor number: </span>{{$order->address->floor_number}}</li>
                  <li><span>Building number: </span>{{$order->address->building_number}}</li>
                  <li><span>Street: </span>{{$order->address->street_name}}</li>
                  <li><span>Area: </span>{{$order->address->area->name .','.$order->address->area->address}} </li>
              </ul>
              <p><i class="fas fa-hand-holding-usd"></i> <span>Total Price:</span>  {{$order->total_price/100}} $</p>
             <p><i class="fa fa-calendar"></i> <span>Created_at</span> {{$order->created_at->format('d M Y')}}</p>
              <p><i class="fa fa-calendar"></i><span> Updated_at</span> {{$order->updated_at->format('d M Y')}}</p>    </div>
        </div>
        <a href="{{route('dashboard.orders.index')}}" class="btn btn-secondary d-block mx-auto mt-1" style="width:80%;">Cancel</a>
    </div>
</div>


@endsection
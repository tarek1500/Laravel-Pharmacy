@extends('app')
@section('title', 'Revenues')
@section('content')
@role('admin')
<div class="container">    
<div class="card text-center bg-success p-0">
  <div class="card-body p-2">
    <h3>Total Revenue is {{$total}}</h3>
  </div>
</div>

<div class="table-responsive">

<table  style="width:100%" class="table table-bordered " id="revenue_table">
  <thead>
    <tr>
      <th scope="col">PharmacyAvatar</th>
      <th scope="col">PharmacyName</th>
      <th scope="col">TotalOrders</th>
      <th scope="col">TotalRevenue</th>
    </tr>
  </thead>
</table>
</div>
</div>
@endsection

@section('script')
  <script>
$(document).ready(function(){

 $('#revenue_table').DataTable({
  processing: true,
  serverSide: true,
  "dom": '<"top"if>rt<"bottom"lp><"clear">',
  ajax:'{{ route('dashboard.revenue.index') }}',
  
               columns: [
                        { data: 'avatar_image', name: 'avatar_image' ,
                          render: function(data, type, full, meta){
                           return "<img src=/images/pharmacy_avatar/" + data + " alt='avatar' height='42' width='42' />";}},
                        { data: 'name', name: 'name' },
                        { data: 'TotalOrders', name: 'TotalOrders' },
                        { data: 'TotalRevenue', name: 'TotalRevenue' },
                        
                     ],
            });
         });
  </script>
@endrole
@role('pharmacy','pharmacy')
<div class="revenue-card" >
<div class="container ">
  <div class="row">
    <div class="col-12 col-sm-8 col-md-6 ">
      <div class="card text-center">
        <div class="card-header text-center border-bottom-0 bg-transparent text-success pt-4">
          <h5>Your pharmacy revenue</h5>
        </div>
        <div class="card-body">
          <h1>${{$myTotal}}</h1>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><i class="fas fa-male text-success mx-2"></i>Keep the good work up</li>
        </ul>
      </div>
    </div>
  </div>
</div>
</div>
@endrole
@endsection


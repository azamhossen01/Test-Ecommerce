@extends('layouts.backend')

@section('content')
<div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Order List</li>
    </ol>




    <!-- DataTables Example -->
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show"><strong>{{Session::get('success')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="panel-group">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Order Details
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Order ID</th>
                            <td>{{$order->id}}</td>
                            <th>Order Status</th>
                            <td>{{Str::title($order->order_status)}}</td>
                            <th>Order Date</th>
                            <td>{{$order->created_at->format('F d Y h:i a')}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Ordered Items
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($order->order_details as $key=>$order_item)
                            <tr>
                                <td>{{$order_item->product->name}}</td>
                                <td>BDT {{$order_item->price}}</td>
                                <td>{{$order_item->quantity}}</td>
                                <td>{{$order_item->price*$order_item->quantity}}</td>
                            </tr>
                            @empty

                            @endforelse

                        </tbody>
                    </table>

                    <!-- <div class="order-summary"> -->

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <i class="fas fa-table"></i> Order Summary
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Subtotal</th>
                            <td>BDT
                                {{$order->subtotal}}</td>
                        </tr>
                        <tr>
                            <th>Tax</th>
                            <td>BDT
                                {{$order->tax}}</td>
                        </tr>
                        <tr>
                            <th>Shipping</th>
                            <td>Free</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>BDT
                                {{$order->total}}</td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>


        <div class="card">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Billing Details
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Full Name</th>
                        <td>{{$order->full_name}}</td>
                        <th>Email</th>
                        <td>{{$order->user->email}}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{$order->phone}}</td>
                        <th>Zip/Postal Code</th>
                        <td>{{$order->postal_code}}</td>
                    </tr>
                    <tr>
                        <th>Line 1</th>
                        <td>{{$order->address1}}</td>
                        <th>Line 2</th>
                        <td>{{$order->address2}}</td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td>{{$order->city}}</td>
                        <th>District</th>
                        <td>{{$order->district}}</td>
                    </tr>
                    
                </table>
            </div>
        </div>

    </div>

</div>
@endsection
@extends('layouts.frontend')

@push('css')
<!-- Page level plugin CSS-->
<link href="{{asset('backend')}}/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
@endpush

@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index-2.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-9 order-lg-last dashboard-content">
                <h2>My Dashboard</h2>
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
                        <td>{{$order->firstname}}</td>
                        <th>Email</th>
                        <td>{{$order->user->email}}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{$order->mobile}}</td>
                        <th>Email</th>
                        <td>{{$order->email}}</td>
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
                    <tr>
                        <th>Zip/Postal Code</th>
                        <td>{{$order->postalcode}}</td>
                        <th>Country</th>
                        <td>Bangladesh</td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
                
            </div>
                @include('frontend.partials.sidebar')


        </div><!-- End .row -->
    </div><!-- End .container -->
</main><!-- End .main -->
@endsection

@push('js')
<script src="{{asset('backend')}}/vendor/datatables/jquery.dataTables.js"></script>
<script src="{{asset('backend')}}/vendor/datatables/dataTables.bootstrap4.js"></script>
@endpush
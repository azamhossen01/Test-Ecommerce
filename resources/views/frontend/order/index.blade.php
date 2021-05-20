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

						<div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Order List
            <!-- <a href="{{route('categories.create')}}" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Add New</a> -->
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Subtotal</th>
                            <th>Tax</th>
                            <th>Total</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th>Action</th>
                           
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Order ID</th>
                            <th>Subtotal</th>
                            <th>Tax</th>
                            <th>Total</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th>Action</th>
                            
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($orders as $key=>$order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->subtotal}}</td>
                            <td>{{$order->tax}}</td>
                            <td>{{$order->total}}</td>
                            <td>{{$order->user->name}}</td>
                            <td>{{$order->user->email}}</td>
                            <td>{{$order->user->customer->phone}}</td>
                            <td>{{$order->order_status}}</td>
                            <td>{{$order->created_at->format('F d Y')}}</td>
                            <td>
                                <a href="{{route('order.details',$order->id)}}" class="btn btn-success btn-sm"><i
                                        class="fas fa-book-open"></i</a> 
                            </td> 
                            
                              
                        </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
					</div><!-- End .col-lg-9 -->

					@include('frontend.partials.sidebar')

                    
				</div><!-- End .row -->
			</div><!-- End .container -->
		</main><!-- End .main -->
@endsection

@push('js')
<script src="{{asset('backend')}}/vendor/datatables/jquery.dataTables.js"></script>
  <script src="{{asset('backend')}}/vendor/datatables/dataTables.bootstrap4.js"></script>
@endpush
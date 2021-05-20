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
                            <th>Status</th>
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
                            <th>Status</th>
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
                                        class="fas fa-book-open"></i</a> </td> <td>
                                        <div class="dropdown">
                                            <button class="btn btn-success btn-sm dropdown-toggle"
                                                data-toggle="dropdown">
                                                <span class="caret"></span>
                                                Status</button>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item"><a
                                                        href="{{ url('change_order_status/ ' . $order->id . '/Received')}}">Received</a>
                                                </li>
                                                <li class="dropdown-item"><a
                                                        href="{{url('change_order_status/'.$order->id.'/Completed')}}">Completed</a>
                                                </li>
                                            </ul>
                                        </div>
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

</div>
@endsection
@extends('layouts.backend')

@section('content')

<div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('home')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Product Details</li>
        </ol>

        <!-- Page Content -->
        <h1>Product Details <a href="{{route('products.index')}}" class="btn btn-success float-right"><i class="fas fa-backward"></i> Back</a></h1>
        <hr>
        <div class="row">
            <div class="col-lg-6">
            <p><strong>1. Product Name </strong> : {{Str::title($product->name)}}</p>
        <p><strong>2. Product Slug </strong> : {{$product->slug}}</p>
        <p><strong>3. Product Price </strong> : {{$product->price}}</p>
        <p><strong>4. Product Status </strong> : {{$product->stock_status}}</p>
        <p><strong>5. Product Quantity </strong> : {{$product->quantity}}</p>
        <p><strong>6. Product Description </strong> : {!!$product->description!!}</p>
            </div>
            <div class="col-lg-6">
                <img src="{{asset('storage/products/'.$product->image)}}" width="100%" alt="">
            </div>
        </div>

      </div>

@endsection
@extends('layouts.frontend')

@section('title','Thank You')

@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index-2.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Product</li>
            </ol>
        </div>
    </nav>

    <div class="container">
        <div class="product-single-container product-single-default">
            <div class="row">
                <div class="col-md-12 product-single-gallery">
                    <div class="jumbotron text-center">
                        <h1 class="display-3">Thank You!</h1>
                        <!-- <p class="lead"><strong>Please check your email</strong> for further instructions on how to
                            complete your account setup.</p> -->
                        <hr>
                        <p>
                            See order details <a href="{{route('order.details',$order->id)}}">Click here</a>
                        </p>
                        <p class="lead">
                            <a class="btn btn-primary btn-sm" href="/"
                                role="button">Continue to homepage</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
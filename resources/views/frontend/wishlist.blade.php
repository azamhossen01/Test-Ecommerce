@extends('layouts.frontend')

@section('title','Wishlist')

@push('css')

@endpush

@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index-2.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart </li>
            </ol>
        </div>
    </nav>

    <div class="container mb-6">
        <div class="row">
            <div class="col-lg-8">


                <div class="cart-table-container">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($wishlists as $key=>$wishlist)
                            <tr>
                                <td>{{$wishlist->id}}</td>
                                <td>{{$wishlist->name}}</td>
                                <td>{{$wishlist->price}}</td>
                                <td>{{$wishlist->model->category->name}}</td>
                                <td>
                                    <a href="{{route('move_to_cart',$wishlist->rowId)}}"  class="btn btn-success btn-sm">Move to cart</a>
                                   <a href="{{route('remove_from_wishlist',$wishlist->rowId)}}" class="btn btn-warning btn-sm">Remove</a>
                                </td>
                            </tr>
                            @empty

                                <h1>Wishlist is empty</h1>

                            @endforelse
                        </tbody>
                    </table>

                </div><!-- End .cart-table-container -->






            </div><!-- End .col-lg-8 -->


        </div><!-- End .row -->
    </div><!-- End .container -->
</main><!-- End .main -->

@endsection

@push('js')
<script>
    
</script>
@endpush
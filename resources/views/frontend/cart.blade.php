@extends('layouts.frontend')

@section('title','Cart')

@push('css')
<style>
    input,
    textarea {
        border: 1px solid #eeeeee;
        box-sizing: border-box;
        margin: 0;
        outline: none;
        padding: 10px;
    }

    input[type="button"] {
        -webkit-appearance: button;
        cursor: pointer;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }

    .input-group {
        clear: both;
        margin: 15px 0;
        position: relative;
    }

    .input-group input[type='button'] {
        background-color: #eeeeee;
        min-width: 38px;
        width: auto;
        transition: all 300ms ease;
    }

    .input-group .button-minus,
    .input-group .button-plus {
        font-weight: bold;
        height: 38px;
        padding: 0;
        width: 38px;
        position: relative;
    }

    .input-group .quantity-field {
        position: relative;
        height: 38px;
        left: -6px;
        text-align: center;
        width: 62px;
        display: inline-block;
        font-size: 13px;
        margin: 0 0 5px;
        resize: vertical;
    }

    .button-plus {
        left: -13px;
    }

    input[type="number"] {
        -moz-appearance: textfield;
        -webkit-appearance: none;
    }
</style>
@endpush

@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index-2.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </div>
    </nav>

    <div class="container mb-6">
        <div class="row">
            <div class="col-lg-8">
           
              @if(Cart::instance('cart')->count() > 0)
                <div class="cart-table-container">
                
                    <table class="table table-cart">
                        <thead>
                            <tr>
                                <th class="product-col">Product</th>
                                <th class="price-col">Price</th>
                                <th class="qty-col">Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <form action="{{route('update_cart')}}" method="post" id="myForm" class="d-none">
                            @csrf
                        <tbody>
                       
                            @forelse(Cart::instance('cart')->content() as $key=>$cart)
                            <tr class="product-row">
                                <td class="product-col">
                                    <figure class="product-image-container">
                                        <a href="product.html" class="product-image">
                                            <img src="{{asset('storage/products/'.$cart->model->image)}}" alt="product">
                                        </a>
                                    </figure>
                                    <h2 class="product-title">
                                        <a href="product.html">{{$cart->name}}</a>
                                    </h2>
                                </td>
                                <td>BDT {{$cart->price}}</td>
                                <td>
                                    <!-- <input class="vertical-quantity form-control" type="text"> -->
                                    
                                    <div class="input-group">
                                        <input type="button" value="-" class="button-minus" data-id="{{$cart->id}}" data-field="quantity">
                                        <input type="number" step="1" max="" value="{{$cart->qty}}" id="{{$cart->id}}" name="quantity"
                                            class="quantity-field">
                                            <input type="hidden" value="{{$cart->qty}}" id="qty{{$cart->id}}" name="qty[]">
                                            <input type="hidden" value="{{$cart->rowId}}"  name="row_id[]">
                                        <input type="button" value="+" class="button-plus"  data-id="{{$cart->id}}" data-field="quantity">
                                    </div>
                                   
                                </td>
                                <td>BDT {{$cart->subtotal}}</td>
                            </tr>
                            <tr class="product-action-row">
                                <td colspan="4" class="clearfix">
                                    <div class="float-left">
                                        <a href="#" class="btn-move">Move to Wishlist</a>
                                    </div><!-- End .float-left -->

                                    <div class="float-right">
                                        <a href="#" title="Edit product" class="btn-edit"><span
                                                class="sr-only">Edit</span><i class="icon-pencil"></i></a>
                                        <a href="#" title="Remove product" class="btn-remove"><span
                                                class="sr-only">Remove</span></a>
                                    </div><!-- End .float-right -->
                                </td>
                            </tr>
                            
                            @empty
                            <h1>Cart is empty</h1>
                            @endforelse

                        </tbody>
                        </form>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="clearfix">
                                    <div class="float-left">
                                        <a href="{{route('/')}}" class="btn btn-outline-secondary">Continue Shopping</a>
                                    </div><!-- End .float-left -->

                                    <div class="float-right">
                                        <a href="{{route('cart.clear')}}"
                                            class="btn btn-outline-secondary btn-clear-cart">Clear Shopping
                                            Cart</a>
                                        <a href="javascript:void(0)" onclick="updateShoppingCart()"
                                            class="btn btn-outline-secondary btn-update-cart" id="btn_update_cart">Update Shopping
                                            Cart</a>
                                    </div><!-- End .float-right -->
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    
                </div><!-- End .cart-table-container -->
           
                <div class="cart-discount">
                    <h4>Apply Discount Code</h4>
                    <form action="#">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" placeholder="Enter discount code"
                                required>
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" type="submit">Apply Discount</button>
                            </div>
                        </div><!-- End .input-group -->
                    </form>
                </div><!-- End .cart-discount -->
                @else 

                <h1>Cart is empty</h1>

            @endif

            </div><!-- End .col-lg-8 -->

            <div class="col-lg-4">
                <div class="cart-summary">
                    <h3>Summary</h3>

                    <h4>
                        <a data-toggle="collapse" href="#total-estimate-section" class="collapsed" role="button"
                            aria-expanded="false" aria-controls="total-estimate-section">Estimate Shipping and Tax</a>
                    </h4>

                    <div class="collapse" id="total-estimate-section">
                        <form action="#">
                            <div class="form-group form-group-sm">
                                <label>Country</label>
                                <div class="select-custom">
                                    <select class="form-control form-control-sm">
                                        <option value="USA">United States</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="China">China</option>
                                        <option value="Germany">Germany</option>
                                    </select>
                                </div><!-- End .select-custom -->
                            </div><!-- End .form-group -->

                            <div class="form-group form-group-sm">
                                <label>State/Province</label>
                                <div class="select-custom">
                                    <select class="form-control form-control-sm">
                                        <option value="CA">California</option>
                                        <option value="TX">Texas</option>
                                    </select>
                                </div><!-- End .select-custom -->
                            </div><!-- End .form-group -->

                            <div class="form-group form-group-sm">
                                <label>Zip/Postal Code</label>
                                <input type="text" class="form-control form-control-sm">
                            </div><!-- End .form-group -->

                            <div class="form-group form-group-custom-control">
                                <label>Flat Way</label>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="flat-rate">
                                    <label class="custom-control-label" for="flat-rate">Fixed $5.00</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .form-group -->

                            <div class="form-group form-group-custom-control">
                                <label>Best Rate</label>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="best-rate">
                                    <label class="custom-control-label" for="best-rate">Table Rate $15.00</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .form-group -->
                        </form>
                    </div><!-- End #total-estimate-section -->

                    <table class="table table-totals">
                        <tbody>
                            <tr>
                                <td>Subtotal</td>
                                <td>BDT {{Cart::instance('cart')->subtotal() ?? 0}}</td>
                            </tr>

                            <tr>
                                <td>Tax (5%)</td>
                                <td>BDT {{Cart::instance('cart')->tax() ?? 0}}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Order Total</td>
                                <td>BDT {{Cart::instance('cart')->total() ?? 0}}</td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="checkout-methods">
                        <a href="{{route('checkout')}}" class="btn btn-block btn-sm btn-primary">Go to Checkout</a>
                        <!-- <a href="#" class="btn btn-link btn-block">Check Out with Multiple Addresses</a> -->
                    </div><!-- End .checkout-methods -->
                </div><!-- End .cart-summary -->
            </div><!-- End .col-lg-4 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</main><!-- End .main -->

@endsection

@push('js')
<script>
    function incrementValue(e) {
        e.preventDefault();
        
        var fieldName = $(e.target).data('field');
        var parent = $(e.target).closest('div');
        var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

        if (!isNaN(currentVal)) {
            parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
        } else {
            parent.find('input[name=' + fieldName + ']').val(0);
        }
        var id = $(e.target).data('id');
        var data = $('#'+id).val();
        console.log(data);
        $('#qty'+id).val(data);
    }

    function decrementValue(e) {
        e.preventDefault();
        var fieldName = $(e.target).data('field');
        var parent = $(e.target).closest('div');
        var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

        if (!isNaN(currentVal) && currentVal > 1) {
            parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
        } else {
            parent.find('input[name=' + fieldName + ']').val(1);
        }
        var id = $(e.target).data('id');
        var data = $('#'+id).val();
        console.log(data);
        $('#qty'+id).val(data);
    }

    $('.input-group').on('click', '.button-plus', function (e) {
        incrementValue(e);
    });

    $('.input-group').on('click', '.button-minus', function (e) {
        decrementValue(e);
    });
</script>

<script>
    $(document).ready(function(){
        $("#btn_update_cart").click(function(){        
        $("#myForm").submit(); // Submit the form
    });
    });
</script>
@endpush
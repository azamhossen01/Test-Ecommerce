@extends('layouts.frontend')

@section('title','Checkout')

@section('content')
<main class="main">
			<nav aria-label="breadcrumb" class="breadcrumb-nav">
				<div class="container">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index-2.html"><i class="icon-home"></i></a></li>
						<li class="breadcrumb-item active" aria-current="page">Checkout</li>
					</ol>
				</div>
			</nav>

			<div class="container mb-6">
				<ul class="checkout-progress-bar">
					<li>
						<span>Shipping</span>
					</li>
					<li class="active">
						<span>Review &amp; Payments</span>
					</li>
				</ul>
				<div class="row">
					<div class="col-lg-4">
						<div class="order-summary">
							<h3>Summary</h3>

							<h4>
								<a data-toggle="collapse" href="#order-cart-section" class="collapsed" role="button" aria-expanded="false" aria-controls="order-cart-section">{{Cart::instance('cart')->content()->count()}} products in Cart</a>
							</h4>

							<div class="collapse" id="order-cart-section">
								<table class="table table-mini-cart">
									<tbody>
                                        @forelse(Cart::instance('cart')->content() as $key=>$cart)
										<tr>
											<td class="product-col">
												<figure class="product-image-container">
													<a href="product.html" class="product-image">
														<img src="{{asset('storage/products/'.$cart->model->image)}}" alt="product">
													</a>
												</figure>
												<div>
													<h2 class="product-title">
														<a href="product.html">{{$cart->name}}</a>
													</h2>

													<span class="product-qty">Qty: {{$cart->qty}}</span>
												</div>
											</td>
											<td class="price-col">BDT {{$cart->price}}</td>
										</tr>
                                        @empty 

                                        @endforelse
										
									</tbody>	
								</table>
							</div><!-- End #order-cart-section -->
						</div><!-- End .order-summary -->

						<div class="checkout-info-box">
							<h3 class="step-title">Ship To:
								<a href="#" title="Edit" class="step-title-edit"><span class="sr-only">Edit</span><i class="icon-pencil"></i></a>
							</h3>

							<address>
								Desmond Mason <br>
								123 Street Name, City, USA <br>
								Los Angeles, California 03100 <br>
								United States <br>
								(123) 456-7890
							</address>
						</div><!-- End .checkout-info-box -->

						<div class="checkout-info-box">
							<h3 class="step-title">Shipping Method: 
								<a href="#" title="Edit" class="step-title-edit"><span class="sr-only">Edit</span><i class="icon-pencil"></i></a>
							</h3>

							<p>Flat Rate - Fixed</p>
						</div><!-- End .checkout-info-box -->
					</div><!-- End .col-lg-4 -->

					<div class="col-lg-8 order-lg-first">
					<form action="{{route('order_placed')}}" method="post">
						@csrf 
						<div class="checkout-payment">
							<h2 class="step-title">Payment Method:</h2>

							<!-- <h4>Check / Money order</h4> -->
                            <h4>Cash on delivery</h4>

							<div class="form-group-custom-control">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="change-bill-address" value="1">
									<label class="custom-control-label" for="change-bill-address">My billing and shipping address are the same</label>
								</div><!-- End .custom-checkbox -->
							</div><!-- End .form-group -->

							<div id="checkout-shipping-address">
								<address>
									Desmond Mason <br>
									123 Street Name, City, USA <br>
									Los Angeles, California 03100 <br>
									United States <br>
									(123) 456-7890
								</address>
							</div><!-- End #checkout-shipping-address -->

							<div id="new-checkout-address" class="show">
									<div class="form-group required-field">
										<label>Full Name </label>
										<input type="text"  name="full_name" value="{{old('full_nam',Auth::user()->name)}}" class="form-control" required>
										@error('full_name') 
											<small class="text-danger">{{$message}}</small>
										@enderror
									</div><!-- End .form-group -->

									<!-- <div class="form-group required-field">
										<label>Last Name </label>
										<input type="text" class="form-control" required>
									</div> -->
									<!-- End .form-group -->

									<div class="form-group required-field">
										<label>Company </label>
										<input type="text" required name="company" value="{{old('company',Auth::user()->customer->company)}}"  class="form-control">
										@error('company') 
											<small class="text-danger">{{$message}}</small>
										@enderror
									</div><!-- End .form-group -->

									<div class="form-group required-field">
										<label>Street Address </label>
										<input type="text"   name="address1" value="{{old('address1',Auth::user()->customer->address1)}}" class="form-control" required>
										@error('address1') 
											<small class="text-danger">{{$message}}</small>
										@enderror
										<input type="text" name="address2" value="{{old('address2',Auth::user()->customer->address2)}}" class="form-control">
									</div><!-- End .form-group -->

									<div class="form-group required-field">
										<label>City  </label>
										<input type="text"   name="city" value="{{old('city',Auth::user()->customer->city)}}" class="form-control" required>
										@error('city') 
											<small class="text-danger">{{$message}}</small>
										@enderror
									</div><!-- End .form-group -->

									<div class="form-group  required-field">
										<label>District</label>
										<div class="select-custom">
											<select name="district" class="form-control" required >
												<option {{Auth::user()->customer->district == 'Dhaka' ? 'selected' : ''}} value="Dhaka">Dhaka</option>
												<option {{Auth::user()->customer->district == 'Chittagong' ? 'selected' : ''}} value="Chittagong">Chittagong</option>
												<option {{Auth::user()->customer->district == 'Rajshahi' ? 'selected' : ''}} value="Rajshahi">Rajshahi</option>
												<option {{Auth::user()->customer->district == 'Khulna' ? 'selected' : ''}} value="Khulna">Khulna</option>
												<option {{Auth::user()->customer->district == 'Barishal' ? 'selected' : ''}} value="Barishal">Barishal</option>
												<option {{Auth::user()->customer->district == 'Sylhet' ? 'selected' : ''}} value="Sylhet">Sylhet</option>
												<option {{Auth::user()->customer->district == 'Comilla' ? 'selected' : ''}} value="Comilla">Comilla</option>
											</select>
											@error('district') 
											<small class="text-danger">{{$message}}</small>
										@enderror
										</div><!-- End .select-custom -->
									
									</div><!-- End .form-group -->

									<!-- <div class="form-group">
										<label>State/Province</label>
										<div class="select-custom">
											<select class="form-control">
												<option value="CA">California</option>
												<option value="TX">Texas</option>
											</select>
										</div>
									</div> -->
									<!-- End .form-group -->

									<div class="form-group required-field">
										<label>Zip/Postal Code </label>
										<input type="text"  name="postal_code" value="{{old('postal_code',Auth::user()->customer->postal_code)}}" class="form-control" required>
										@error('postal_code') 
											<small class="text-danger">{{$message}}</small>
										@enderror
									</div><!-- End .form-group -->

									

									<div class="form-group required-field">
										<label>Phone Number </label>
										
											<input type="tel"  name="phone" value="{{old('phone',Auth::user()->customer->phone)}}" class="form-control" required>
											@error('phone') 
											<small class="text-danger">{{$message}}</small>
										@enderror
										
									</div><!-- End .form-group -->

									<!-- <div class="form-group-custom-control">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="address-save">
											<label class="custom-control-label" for="address-save">Save in Address book</label>
										</div>
									</div> -->
									<!-- End .form-group -->
							</div><!-- End #new-checkout-address -->

							<div class="clearfix">
								<!-- <a href="#" class="btn btn-primary float-right">Place Order</a> -->
								<button class="btn btn-primary float-right" type="submit">Place Order</button>
							</div><!-- End .clearfix -->
						</div><!-- End .checkout-payment -->
					</form>
						<div class="checkout-discount">
							<h4>
								<a data-toggle="collapse" href="#checkout-discount-section" class="collapsed" role="button" aria-expanded="false" aria-controls="checkout-discount-section">Apply Discount Code</a>
							</h4>

							<div class="collapse" id="checkout-discount-section">
								<form action="#">
										<input type="text" class="form-control form-control-sm" placeholder="Enter discount code"  required>
										<button class="btn btn-sm btn-outline-secondary" type="submit">Apply Discount</button>
								</form>
							</div><!-- End .collapse -->
						</div><!-- End .checkout-discount -->
					</div><!-- End .col-lg-8 -->
				</div><!-- End .row -->
			</div><!-- End .container -->
		</main><!-- End .main -->
@endsection
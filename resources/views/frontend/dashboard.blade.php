@extends('layouts.frontend')

@section('title','Dashboard')

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

						<div class="alert alert-success alert-intro" role="alert">
							Thank you for registering
						</div><!-- End .alert -->

						
					</div><!-- End .col-lg-9 -->

					@include('frontend.partials.sidebar')

                    
				</div><!-- End .row -->
			</div><!-- End .container -->
		</main><!-- End .main -->
@endsection
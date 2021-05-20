@extends('layouts.frontend')


@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Customer Register</li>
            </ol>
        </div>
    </nav>

    <div class="container mb-6">
        <!-- <ul class="checkout-progress-bar">
            <li class="active">
                <span>Shipping</span>
            </li>
            <li>
                <span>Review &amp; Payments</span>
            </li>
        </ul> -->
        <div class="row">
            <div class="col-lg-12">
                <ul class="checkout-steps">
                    <li>
                        <h2 class="step-title">Customer Registration</h2>



                        <form action="{{route('register')}}" style="max-width:100%">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group required-field">
                                        <label>First Name </label>
                                        <input type="text" name="first_name" class="form-control" required placeholder="Write Your First Name">
                                    </div><!-- End .form-group -->


                                    <div class="form-group required-field">
                                        <label>Street Address Line 1</label>
                                        <input type="text" name="address1" class="form-control" required placeholder="Write Address Line 1">
                                    </div><!-- End .form-group -->
                                    <div class="form-group required-field">
                                        <label>Phone Number </label>
                                        <input type="tel" name="phone" class="form-control" required placeholder="Write Your Phone Number">
                                    </div><!-- End .form-group -->

                                    <div class="form-group required-field">
                                        <label>City </label>
                                        <input type="text" name="city" class="form-control" required placeholder="Write City">
                                    </div><!-- End .form-group -->

                                    <div class="form-group required-field">
                                <label>Zip/Postal Code </label>
                                <input type="text" name="postal_code" class="form-control" required placeholder="Write Zip/Postal Code ">
                            </div><!-- End .form-group -->

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group required-field">
                                        <label>Last Name </label>
                                        <input type="text" name="last_name" class="form-control" required placeholder="Write Your Last Name">
                                    </div><!-- End .form-group -->
                                    <div class="form-group required-field">
                                        <label>Street Address Line 2</label>
                                        <input type="text" name="address2" class="form-control" required placeholder="Write Address Line 2">
                                    </div><!-- End .form-group -->
                                    
                                    <div class="form-group required-field">
                                        <label>Email </label>
                                        <input type="email" name="email" class="form-control" required placeholder="Write Your Email Address">
                                    </div><!-- End .form-group -->

                                    <div class="form-group">
                                        <label>District</label>
                                        <div class="select-custom">
                                            <select name="district" class="form-control">
                                                <option value="Dhaka">Dhaka</option>
                                                <option value="Chittagong">Chittagong</option>
                                                <option value="Rajshahi">Rajshahi</option>
                                                <option value="Khulna">Khulna</option>
                                                <option value="Barishal">Barishal</option>
                                                <option value="Sylhet">Sylhet</option>
                                                <option value="Comilla">Comilla</option>
                                            </select>
                                        </div><!-- End .select-custom -->
                                    </div><!-- End .form-group -->

                                    <div class="form-group">
                                        <label>Company </label>
                                        <input type="text" name="company" class="form-control" placeholder="Write Your Company">
                                    </div><!-- End .form-group -->
                                </div>
                            </div>




                            <div class="form-group">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </li>


                </ul>
            </div><!-- End .col-lg-8 -->


        </div><!-- End .row -->


    </div><!-- End .container -->
</main><!-- End .main -->
@endsection
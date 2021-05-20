@extends('layouts.frontend')

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
						<h2>My Profile</h2>

						<div class="container-fluid">

    



    @if(Session::has('errors'))
    @forelse(Session::get('errors') as $error)
    <div class="alert alert-danger">{{$error}}</div>
    @empty

    @endforelse
    @endif

    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show"><strong>{{Session::get('success')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="card-title mb-4">
                        <div class="d-flex justify-content-start">
                            <form action="{{route('profile_image.update',$user->customer->id)}}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="image-container">
                                    <img src="{{asset('storage/customers/'.$user->customer->avatar)}}" id="imgInp"
                                        style="width: 150px; height: 150px" class="img-thumbnail showimagediv" />



                                    <div class="middle">
                                        <input type="file" style="display: block;" class="gallerythumbnail"
                                            id="profilePicture" name="image" />
                                        <input type="submit" class="btn btn-primary mt-2" id="btnChangePicture"
                                            value="Change" />
                                    </div>
                                </div>



                            </form>


                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo"
                                        role="tab" aria-controls="basicInfo" aria-selected="true">Basic Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="connectedServices-tab" data-toggle="tab"
                                        href="#connectedServices" role="tab" aria-controls="connectedServices"
                                        aria-selected="false">Update Profile</a>
                                </li>
                            </ul>
                            <div class="tab-content ml-1" id="myTabContent">
                                <div class="tab-pane fade show active" id="basicInfo" role="tabpanel"
                                    aria-labelledby="basicInfo-tab">


                                    <p><Strong>Name : </Strong> {{$user->name}}</p>
                                    <p><Strong>Email : </Strong> {{$user->email}}</p>
                                    <p><Strong>Phone : </Strong> {{$user->customer->phone??'empty'}}</p>
                                    <p><Strong>Address : </Strong>
                                        {{$user->customer->address1.' '.$user->customer->address2}}</p>
                                    <p><Strong>Company : </Strong> {{$user->customer->company??'empty'}}</p>
                                    <p><Strong>City : </Strong> {{$user->customer->city??'empty'}}</p>
                                    <p><Strong>District : </Strong> {{$user->customer->district??'empty'}}</p>
                                    <p><Strong>Postal/Zip Code : </Strong> {{$user->customer->postal_code ?? 'empty'}}
                                    </p>

                                </div>
                                <div class="tab-pane fade" id="connectedServices" role="tabpanel"
                                    aria-labelledby="ConnectedServices-tab">
                                    <form action="{{route('profile.update',Auth::id())}}" style="max-width:100%"
                                        method="post">
                                        @csrf
                                        @method('put')
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group required-field">
                                                    <label>Full Name </label>
                                                    <input type="text" value="{{old('full_name',$user->name)}}"
                                                        name="full_name" class="form-control"
                                                        placeholder="Write Your Full Name">
                                                    @error('full_name')
                                                    <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                </div><!-- End .form-group -->


                                                <div class="form-group -field">
                                                    <label>Street Address Line 1</label>
                                                    <input type="text"
                                                        value="{{old('address1',$user->customer->address1)}}"
                                                        name="address1" class="form-control"
                                                        placeholder="Write Address Line 1">
                                                    @error('address1')
                                                    <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                </div><!-- End .form-group -->
                                                <div class="form-group -field">
                                                    <label>Phone Number </label>
                                                    <input type="tel" value="{{old('phone',$user->customer->phone)}}"
                                                        name="phone" class="form-control"
                                                        placeholder="Write Your Phone Number">
                                                    @error('phone')
                                                    <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                </div><!-- End .form-group -->

                                                <div class="form-group -field">
                                                    <label>City </label>
                                                    <input type="text" value="{{old('city',$user->customer->city)}}"
                                                        name="city" class="form-control" placeholder="Write City">
                                                    @error('city')
                                                    <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                </div><!-- End .form-group -->

                                                <div class="form-group -field">
                                                    <label>Zip/Postal Code </label>
                                                    <input type="text"
                                                        value="{{old('postal_code',$user->customer->postal_code)}}"
                                                        name="postal_code" class="form-control"
                                                        placeholder="Write Zip/Postal Code ">
                                                    @error('postal_code')
                                                    <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                </div><!-- End .form-group -->

                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group -field">
                                                    <label>Email </label>
                                                    <input type="email" value="{{old('email',$user->email)}}"
                                                        name="email" class="form-control"
                                                        placeholder="Write Your Email Address">
                                                    @error('email')
                                                    <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                </div><!-- End .form-group -->
                                                <div class="form-group -field">
                                                    <label>Street Address Line 2</label>
                                                    <input type="text"
                                                        value="{{old('address2',$user->customer->address2)}}"
                                                        name="address2" class="form-control"
                                                        placeholder="Write Address Line 2">
                                                    @error('address2')
                                                    <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                </div><!-- End .form-group -->



                                                <div class="form-group">
                                                    <label>District</label>
                                                    <div class="select-custom">
                                                        <select name="district" class="form-control">
                                                            <option
                                                                {{$user->customer->district == 'Dhaka' ? 'selected' : ''}}
                                                                value="Dhaka">Dhaka</option>
                                                            <option
                                                                {{$user->customer->district == 'Chittagong' ? 'selected' : ''}}
                                                                value="Chittagong">Chittagong</option>
                                                            <option
                                                                {{$user->customer->district == 'Rajshahi' ? 'selected' : ''}}
                                                                value="Rajshahi">Rajshahi</option>
                                                            <option
                                                                {{$user->customer->district == 'Khulna' ? 'selected' : ''}}
                                                                value="Khulna">Khulna</option>
                                                            <option
                                                                {{$user->customer->district == 'Barishal' ? 'selected' : ''}}
                                                                value="Barishal">Barishal</option>
                                                            <option
                                                                {{$user->customer->district == 'Sylhet' ? 'selected' : ''}}
                                                                value="Sylhet">Sylhet</option>
                                                            <option
                                                                {{$user->customer->district == 'Comilla' ? 'selected' : ''}}
                                                                value="Comilla">Comilla</option>
                                                        </select>
                                                    </div><!-- End .select-custom -->
                                                    @error('district')
                                                    <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                </div><!-- End .form-group -->

                                                <div class="form-group">
                                                    <label>Company </label>
                                                    <input type="text"
                                                        value="{{old('company',$user->customer->company)}}"
                                                        name="company" class="form-control"
                                                        placeholder="Write Your Company">
                                                    @error('company')
                                                    <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                </div><!-- End .form-group -->

                                                <div class="form-group -field">
                                                    <label>Password </label>
                                                    <input type="password" name="password" class="form-control"
                                                        placeholder="Change Password ">
                                                    @error('password')
                                                    <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                </div><!-- End .form-group -->
                                            </div>
                                        </div>




                                        <div class="form-group">
                                            <button class="btn btn-warning">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>
					</div><!-- End .col-lg-9 -->

					@include('frontend.partials.sidebar')


				</div><!-- End .row -->
			</div><!-- End .container -->
		</main><!-- End .main -->
@endsection

@push('js')
<script>
    profilePicture.onchange = evt => {
        const [file] = profilePicture.files
        if (file) {
            imgInp.src = URL.createObjectURL(file)
        }
    }
</script>
@endpush
@extends('layouts.backend')

@section('content')

<div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Profile</li>
    </ol>

    <!-- Page Content -->
    <h1>Profile <a href="{{route('products.index')}}" class="btn btn-warning float-right"><i class="fas fa-pen"></i>
            Edit</a></h1>
    <hr>
    <div class="row">
        <div class="col-lg-6">
            <p><Strong>Name : </Strong> {{$user->name}}</p>
            <p><Strong>Email : </Strong> {{$user->email}}</p>
            <p><Strong>Phone : </Strong> {{$user->customer->phone??'empty'}}</p>
            <p><Strong>Address : </Strong> {{$user->customer->address1.' '.$user->customer->address2}}</p>
            <p><Strong>Company : </Strong> {{$user->customer->company??'empty'}}</p>
            <p><Strong>City : </Strong> {{$user->customer->city??'empty'}}</p>
            <p><Strong>District : </Strong> {{$user->customer->district??'empty'}}</p>
            <p><Strong>Postal/Zip Code : </Strong> {{$user->customer->postal_code ?? 'empty'}}</p>
        </div>


    </div>

</div>

@endsection
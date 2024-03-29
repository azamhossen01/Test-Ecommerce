@extends('layouts.backend')

@section('content')
<div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('home')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Product List</li>
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
            Product List
            <a href="{{route('products.create')}}" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Add New</a>
            </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>#Index</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>#Index</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                    @forelse($products as $key=>$product) 
                        <tr>
                            <td>{{$key+1}}</td>
                            <td><img src="{{asset('storage/products/'.$product->image)}}" width="120" alt=""></td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->created_at->format('F d Y')}}</td>
                            <td>
                                <a href="{{route('products.edit',$product->id)}}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                <form action="{{route('products.destroy',$product->id)}}" method="post" class="d-inline-block">
                                @csrf 
                                @method('delete')
                                <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i></button>
                                </form>
                                <a href="{{route('products.show',$product->id)}}" class="btn btn-success btn-sm"><i class="fas fa-book-open"></i></a>
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
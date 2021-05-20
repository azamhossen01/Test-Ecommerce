@extends('layouts.backend')

@section('content')
<div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('home')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Make New Product</li>
        </ol>

        
       

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Add New Product
            <a href="{{route('products.index')}}" class="btn btn-success btn-sm float-right"><i class="fas fa-backward"></i>  Back</a>
            </div>
          <div class="card-body">
            <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
            @csrf 
              <div class="form-group">
                <label for="category_id">Select Category</label>
                <select name="category_id" id="category_id" class="form-control">
                  <option value="">Select Category</option>
                  @forelse($categories as $key=>$category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                  @empty 

                  @endforelse
                </select>
                @error('category_id') <small class="text-danger">{{$message}}</small> @enderror
              </div>
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text"  value="{{old('name')}}" class="form-control" name="name"  placeholder="Write Product Name">
                @error('name') <small class="text-danger">{{$message}}</small> @enderror
              </div>
              <div class="form-group">
                <label for="price">Price</label>
                <input type="number" min="0"  value="{{old('name')}}" class="form-control" name="price"  placeholder="Write Product Price">
                @error('price') <small class="text-danger">{{$message}}</small> @enderror
              </div>
              <div class="form-group">
                <label for="image">Image</label>
                <input type="file"  class="form-control" name="image"  >
                @error('image') <small class="text-danger">{{$message}}</small> @enderror
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" cols="30" rows="5" placeholder="Write Product Description">{{old('description')}}</textarea>
                @error('description') <small class="text-danger">{{$message}}</small> @enderror
              </div>
              <div class="form-group">
                <button class="btn btn-primary" type="submit">Submit</button>
              </div>
            </form>
          </div>
          <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>

      </div>
@endsection
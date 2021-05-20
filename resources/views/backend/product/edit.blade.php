@extends('layouts.backend')

@section('content')
<div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('home')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Update Product</li>
        </ol>

        
       

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Update Product
            <a href="{{route('products.index')}}" class="btn btn-success btn-sm float-right"><i class="fas fa-backward"></i>  Back</a>
            </div>
          <div class="card-body">
          <form action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data">
            @csrf 
            @method('put')
              <div class="form-group">
                <label for="category_id">Select Category</label>
                <select name="category_id" id="category_id" class="form-control">
                  <option value="">Select Category</option>
                  @forelse($categories as $key=>$category)
                  <option {{$category->id == $product->category_id ? 'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                  @empty 

                  @endforelse
                </select>
                @error('category_id') <small class="text-danger">{{$message}}</small> @enderror
              </div>
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text"  value="{{old('name',$product->name)}}" class="form-control" name="name"  placeholder="Write Product Name">
                @error('name') <small class="text-danger">{{$message}}</small> @enderror
              </div>
              <div class="form-group">
                <label for="slug">Product Slug</label>
                <input type="text"  value="{{old('name',$product->slug)}}" class="form-control" name="slug"  placeholder="Write Product Slug">
                @error('slug') <small class="text-danger">{{$message}}</small> @enderror
              </div>
              <div class="form-group">
                <label for="price">Price</label>
                <input type="number" min="0"  value="{{old('name',$product->price)}}" class="form-control" name="price"  placeholder="Write Product Price">
                @error('price') <small class="text-danger">{{$message}}</small> @enderror
              </div>
              <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" min="0"  value="{{old('name',$product->quantity)}}" class="form-control" name="quantity"  placeholder="Write Product Quantity">
                @error('quantity') <small class="text-danger">{{$message}}</small> @enderror
              </div>
              <div class="form-group">
                <label for="stock_status">Stock Status</label>
                <select name="stock_status" id="stock_status" class="form-control">
                  <option value="instock" {{$product->stock_status == 'instock' ? 'selected':''}}>In Stock</option>
                  <option value="outstock"  {{$product->stock_status == 'outstock' ? 'selected':''}}>Out Stock</option>
                </select>
                @error('stock_status') <small class="text-danger">{{$message}}</small> @enderror
              </div>
              <div class="form-group">
                <label for="image">Image</label>
                <input type="file"  class="form-control" name="image"  >
                @error('image') <small class="text-danger">{{$message}}</small> @enderror
                @if($product->image != "default.png" && !empty($product->image)) 
                  <img src="{{asset('storage/products/'.$product->image)}}" width="120" alt="">
                @endif
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" cols="30" rows="5" placeholder="Write Product Description">{{old('description',$product->description)}}</textarea>
                @error('description') <small class="text-danger">{{$message}}</small> @enderror
              </div>
              <div class="form-group">
                <button class="btn btn-warning" type="submit">Update</button>
              </div>
            </form>
          </div>
          <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>

      </div>
@endsection
@extends('layouts.backend')

@section('content')
<div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('home')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Update Category</li>
        </ol>

        
       

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Update Category
            <a href="{{route('categories.index')}}" class="btn btn-success btn-sm float-right"><i class="fas fa-backward"></i>  Back</a>
            </div>
          <div class="card-body">
            <form action="{{route('categories.update',$category->id)}}" method="post">
            @csrf 
            @method('put')
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" value="{{old('name',$category->name)}}" class="form-control" name="name"  placeholder="Write Category Name">
                @error('name') <small class="text-danger">{{$message}}</small> @enderror
              </div>
              <div class="form-group">
                <label for="slug">Slug Name</label>
                <input type="text" value="{{old('slug',$category->slug)}}"  class="form-control" name="slug"  placeholder="Write Category Slug">
                @error('slug') <small class="text-danger">{{$message}}</small> @enderror
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
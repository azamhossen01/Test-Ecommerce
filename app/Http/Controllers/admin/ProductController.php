<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('backend.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status',1)->get();
        return view('backend.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|min:3|max:50|unique:products',
            'image'        =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'description' => 'required'
        ]);
        if($request->hasFile('image')){
            $imageName = Str::slug($request->name).'-'.time().'.'.$request->image->extension();
            if(!Storage::disk('public')->exists('products')){
                Storage::disk('public')->makeDirectory('products');
            }
            $img = Image::make($request->image)->resize(265,263)->stream();
            Storage::disk('public')->put('products/'.$imageName,$img);
        }else{
            $imageName = "default.png";
        }

        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imageName
        ]);
        session()->flash('success','Product added successfully');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('backend.product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::where('status',1)->get();
        $product = Product::findOrFail($id);
        return view('backend.product.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        // $path = "products/"."aa";
        // if (Storage::disk('public')->exists($path)) {
        //     return 'ache';
        // }else{
        //     return 'nai';
        // }
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|min:3|max:50|unique:products,name,'.$id,
            'slug' => 'required|min:3|unique:products,slug,'.$id,
            'image'        =>  'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'description' => 'required',
            'stock_status' => 'required',
            'quantity' => 'required'
        ]);
        if($request->hasFile('image')){
            $imageName = Str::slug($request->name).'-'.time().'.'.$request->image->extension();
            if(!Storage::disk('public')->exists('products')){
                Storage::disk('public')->makeDirectory('products');
            }
            // if(!empty($product->image) && $product->image != 'default.png'){
            //     Storage::disk('public')->delete('products/'.$product->image);
            // }
            if(Storage::disk('public')->exists('products/'.$product->image) && $product->image != 'default.png'){
                Storage::disk('public')->delete('products/'.$product->image);
            }
            $img = Image::make($request->image)->resize(265,263)->stream();
            Storage::disk('public')->put('products/'.$imageName,$img);
        }else{
            $imageName = $product->image;
        }
        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'price' => $request->price,
            'stock_status' => $request->stock_status,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image' => $imageName,
        ]);
        session()->flash('success','Product updated successfully');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if(!empty($product->image) && $product->image != 'default.png'){
            Storage::disk('public')->delete('products/'.$product->image);
        }
        $product->delete();
        session()->flash('success','Product deleted successfully');
        return redirect()->route('products.index');
    }
}

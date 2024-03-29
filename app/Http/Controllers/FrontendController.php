<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class FrontendController extends Controller
{
    public function index(){
        // return Cart::instance('cart')->content();
        $categories = Category::whereHas('products')->where('status',1)->get();
        // $cat = $categories[0];
        // return $cat->products()->latest()->take(2)->get();
        return view('frontend.home',compact('categories'));
    }

    public function product_details($slug){
        
        // return Cart::instance('cart')->content();
        // return Cart::instance('cart')->content();
        // Cart::instance('cart')->destroy();

        // $cart_data = Cart::instance('cart');
            // return $cart_data->content()->count();
        $product = Product::where('slug',$slug)->first();
        $reviews = [];
        // return $product->order_details;
        foreach($product->order_details()->where('review_status',true)->take(3)->latest()->get() as $key=>$order_detail){
            // return $order_detail;
            $reviews[$key] = $order_detail->review;
        }
        // return $reviews;
         $collection = collect($reviews);
        
    //    return  $collection->sortByDesc('id');
        return view('frontend.product_details',compact('product','reviews'));
    }
}

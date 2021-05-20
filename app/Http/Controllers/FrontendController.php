<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class FrontendController extends Controller
{
    public function index(){
        // return Cart::instance('wishlist')->content();
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
        return view('frontend.product_details',compact('product'));
    }
}

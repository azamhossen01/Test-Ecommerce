<?php

namespace App\Http\Controllers\customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{

    public function cart(){
        return view('frontend.cart');
    }

    public function add_to_cart(Request $request){
        // return response()->json($request);
        Cart::instance('cart')->add($request->id,$request->name,1,$request->price)->associate("App\Models\Product");
        // session()->flash('success','Item add to cart');
       $cart_data = Cart::instance('cart')->content();
    //    Toastr::success('Messages in here', 'Title', ["positionClass" => "toast-top-center"]);
       return response()->json($cart_data);
    }

    public function add_to_wishlist(Request $request){
        // return response()->json($request);
        Cart::instance('wishlist')->add($request->id,$request->name,1,$request->price)->associate("App\Models\Product");
        // session()->flash('success','Item add to cart');
       $wishlist_data = Cart::instance('wishlist')->content();
    //    Toastr::success('Messages in here', 'Title', ["positionClass" => "toast-top-center"]);
       return response()->json($wishlist_data);
    }

    public function remove_from_wishlist(Request $request){
        foreach(Cart::instance('wishlist')->content() as $key=>$wishlist){
            if($wishlist->id == $request->id){
                Cart::instance('wishlist')->remove($wishlist->rowId);
            }
        }
        return true;
    }

    public function get_cart_data(){
    $data = [
        'cart_data' => Cart::instance('cart')->content(),
        'total_qty' => Cart::instance('cart')->count(),
        'total_items' => Cart::instance('cart')->content()->count()
    ];
       return $data;
    }

    public function remove_from_cart(Request $request){
        Cart::instance('cart')->remove($request->rowId);
        return true;
    }

    public function cart_clear(){
        Cart::instance('cart')->destroy();
        return redirect()->route('cart');
    }

    public function checkout(){
        if(!Auth::check()){
            Toastr::error('Please login first', 'Error', ["positionClass" => "toast-top-right"]);
            
            return redirect()->route('customer_login');
        }
        return view('frontend.checkout');
    }
}

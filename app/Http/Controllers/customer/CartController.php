<?php

namespace App\Http\Controllers\customer;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{

    public function update_cart(Request $request){
        // return $request;
        foreach($request->row_id as $key=>$r_id){
            foreach(Cart::instance('cart')->content() as $value){
                if($value->rowId == $r_id){
                    Cart::instance('cart')->update($r_id,$request->qty[$key]);
                }
            }
            
        }
        // return Cart::instance('cart')->content();
        Toastr::success('Cart updated successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('cart');
    }

    public function move_to_cart($rowId){
        // $product = Product::findOrFail($request->id);
        $wishlist = Cart::instance('wishlist')->get($rowId);
        $cart_ids = Cart::instance('cart')->content()->pluck('id');
        if($cart_ids->contains($wishlist->id)){
            Toastr::error('Product is already in cart', 'Warning', ["positionClass" => "toast-top-right"]);
        }else{
            Cart::instance('cart')->add($wishlist->id,$wishlist->name,1,$wishlist->price)->associate("App\Models\Product");
            Cart::instance('wishlist')->remove($rowId);
            Toastr::success('Product move to cart', 'Success', ["positionClass" => "toast-top-right"]);
        }
        
            return redirect()->route('wishlist.index');
    }

    public function remove_from_wishlist($rowId){
        Cart::instance('wishlist')->remove($rowId);
        Toastr::success('Product remove from wishlist', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('wishlist.index');
    }


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

    public function decrease_cart(Request $request){
        foreach(Cart::instance('cart')->content() as $key=>$item){
            if($item->model->id == $request->id && $item->qty > 1){
             Cart::instance('cart')->add($request->id,$request->name,-1,$request->price)->associate("App\Models\Product");
            }
        }
       
        // session()->flash('success','Item add to cart');
       $cart_data = Cart::instance('cart')->content();
    //    Toastr::success('Messages in here', 'Title', ["positionClass" => "toast-top-center"]);
       return response()->json($cart_data);
    }

    public function wishlist(){
        $wishlists = Cart::instance('wishlist')->content();
        // return $wishlists;
        return view('frontend.wishlist',compact('wishlists'));
    }

    public function add_to_wishlist(Request $request){
        // return response()->json($request);
        foreach(Cart::instance('wishlist')->content() as $key=>$item){
            if($item->model->id == $request->id){
                Cart::instance('wishlist')->remove($key);
                Toastr::success('Add to wishlist', 'Success', ["positionClass" => "toast-top-right"]);
                return response()->json(['msg' => 'remove']);
            }
        }
        Cart::instance('wishlist')->add($request->id,$request->name,1,$request->price)->associate("App\Models\Product");
       $wishlist_data = Cart::instance('wishlist')->content();
       Toastr::success('Add to wishlist', 'Success', ["positionClass" => "toast-top-right"]);
       return response()->json(['msg' => 'add']);
    }

    // public function remove_from_wishlist(Request $request){
    //     foreach(Cart::instance('wishlist')->content() as $key=>$wishlist){
    //         if($wishlist->id == $request->id){
    //             Cart::instance('wishlist')->remove($wishlist->rowId);
    //         }
    //     }
    //     return true;
    // }

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
            Toastr::error('Please login first', 'Error!', ["positionClass" => "toast-top-right"]);
            
            return redirect()->route('customer_login');
        }elseif(Auth::check() && Cart::instance()->count() < 0){
            Toastr::error('Your cart is empty', 'Warning!', ["positionClass" => "toast-top-right"]);
            
            return redirect()->back();
        }

        return view('frontend.checkout');
    }
}

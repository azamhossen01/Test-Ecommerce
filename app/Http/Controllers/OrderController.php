<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{

    public function index(){
        if(Auth::user()->role == 'admin'){
            $orders = Order::paginate(10);
            return view('backend.order.index',compact('orders'));
        }else{
            $orders = Order::where('user_id',Auth::id())->paginate(10);
            return view('frontend.order.index',compact('orders'));
        }
        
    }


    public function order_placed(Request $request){
        // return $request;
        $request->validate([
            'full_name' => 'required',
            'phone' => 'required',
            'address1' => 'required',
            'city' => 'required',
            'district' => 'required'
        ]);
        $cart_data = Cart::instance('cart');
        // return $cart_data->subtotal();
        $order = Order::create([
            'user_id' => Auth::id(),
            'subtotal' => $cart_data->subtotal(),
            'tax' => $cart_data->tax(),
            'total' => $cart_data->total(),
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'city' => $request->city,
            'district' => $request->district,
            'postal_code' => $request->postal_code,
        ]);
        foreach($cart_data->content() as $key=>$cart){
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $cart->id,
                'price' => $cart->price,
                'quantity' => $cart->qty
            ]);
        }
        Cart::instance('cart')->destroy();
        Toastr::success('Order placed successful', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('thankyou',$order->id);
    }

    public function thankyou($id){
        $order = Order::findOrFail($id);
        return view('frontend.thankyou',compact('order'));
    }


    public function change_order_status($id,$status){
        $order = Order::findOrFail($id);
        $order->update([
            'order_status' => $status
        ]);
        Toastr::success("Order  successful", 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('orders.index');
    }

    public function show($id){
        $order = Order::findOrFail($id);
        if(Auth::user()->role == 'admin'){
            return view('backend.order.show',compact('order'));
        }else{
            return view('frontend.order.show',compact('order'));
        }
        // return $order->order_details;
        
    }

    public function make_review($order_detail_id){
        return view('frontend.order.make_review',compact('order_detail_id'));
    }

    public function review_store(Request $request){
        $request->validate([
            'rating' => 'required',
            'comments' => 'required|max:1000'
        ]);
        $review = Review::create([
            'order_detail_id' => $request->order_detail_id,
            'rating' => $request->rating,
            'comments' => $request->comments
        ]);
        $review->order_detail()->update([
            'review_status' => true
        ]);
        Toastr::success("Submit order review successfully", 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('order.details',$review->order_detail->order_id);
    }
}

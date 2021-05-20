<?php

namespace App\Http\Controllers\customer;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function customer_register(){
        if(Auth::check()){
            return redirect()->back();
        }
        return view('frontend.customer_register');
    }

    public function customer_login(){
        if(Auth::check()){
            return redirect()->back();
        }
        return view('frontend.customer_login');
    }

    public function profile($id){
        $user = User::findOrFail($id);
        return view('frontend.user.profile',compact('user'));
    }

    public function update_profile(Request $request, $id){
         $user = User::findOrFail(Auth::id());
        // return $request;
        $validator = Validator::make($request->all(),[
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth::id()
        ]);
        

        if ($validator->fails()) {
            return redirect("profile/$id")
                        
                        ->withErrors($validator)
                        ->withInput();
        }
        // return $request;
        if($request->password){
            $user->update([
                'name' => $request->full_name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
        }else{
            $user->update([
            'name' => $request->full_name,
            'email' => $request->email
        ]);
        }
        
        $user->customer()->update([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'city' => $request->city,
            'district' => $request->district,
            'company' => $request->company,
            'postal_code' => $request->postal_code,
        ]);

        session()->flash('success','Profile updated successfully');
        return redirect()->route('profile',$id);
    }

    public function profile_image(Request $request,$id){
        // return $request;
        $customer = Customer::findOrFail($id);
        $request->validate([
            'image'        =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if($request->hasFile('image')){

            $imageName = Str::slug($customer->full_name).'-'.time().'.'.$request->image->extension();
            if(!Storage::disk('public')->exists('customers')){
                Storage::disk('public')->makeDirectory('customers');
            }

            if(!empty($customer->avatar) && $customer->avatar != 'default.png'){
                Storage::disk('public')->delete('customers/'.$customer->avatar);
            }
            
            $img = Image::make($request->image)->resize(265,263)->stream();
            Storage::disk('public')->put('customers/'.$imageName,$img);
        }else{
            $imageName = $customer->avatar;
        }
        $customer->update([
            'avatar' => $imageName
        ]);
        session()->flash('success','Profile image updated successfully');
        return redirect()->route('profile',$customer->user_id);
    }
}

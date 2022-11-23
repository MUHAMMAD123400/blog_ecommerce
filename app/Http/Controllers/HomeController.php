<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;

class HomeController extends Controller
{
    //
    public function redirect(){
        $userType = Auth::user()->usertype;

        if($userType == '1'){
            return view('admin.home');
        }else{
            $data = Product::paginate(6);
            $user =  Auth()->user();
            $count = Cart::where('phone' , $user->phone)->count();
            return view('user.home' , compact('data' , 'count'));
        }
    }

    public function index(){
        if (Auth::id()) {
            return redirect('redirect');
        }else{
            $data = Product::paginate(6);
            return view('user.home' , compact('data'));
        }
    }

    public function search(Request $req){
        $search = $req->search;
        if ($search == '') {
            $data = Product::paginate(6);
            return view('user.home' , compact('data'));
        }
        $data = Product::where('title','Like','%'.$search.'%')->get();
        return view('user.home' , compact('data'));
    }

    public function addcart(Request $req , $id){
        if (Auth::id()) {
            $user = Auth()->user();
            $product = Product::find($id);
            $cart = new Cart();
            $cart->name = $user->name;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->product_title = $product->title;
            $cart->price = $product->price;
            $cart->quantity = $req->quantity;
            $cart->save();
            return redirect()->back()->with('message' , 'Product Add Successfully');
        } else {
            return redirect('login');
        }
    }

    public function showcart(){
        $user =  Auth()->user();
        $cart = Cart::where('phone' , $user->phone)->get();
        $count = Cart::where('phone' , $user->phone)->count();
        return view('user.showcart' , compact('count','cart'));
    }

    public function deletecart($id){
        $data = Cart::find($id);
        $data->delete();
        return redirect()->back()->with('message' , 'Product Delete Successfully');
    }

    public function confirmorder(Request $req){
        $user = Auth()->user();
        $name=$user->name;
        $phone=$user->phone;
        $address=$user->address;

        foreach ($req->productname as $key => $productname) {
            $order = new Order();
            $order->product_name = $req->productname[$key]; 
            $order->price = $req->price[$key]; 
            $order->quantity = $req->quantity[$key]; 
            $order->name = $name;
            $order->phone = $phone;
            $order->address = $address;
            $order->status = 'not delivered';

            $order->save();
        }
        DB::table('carts')->where('phone' , $phone)->delete();
        return redirect()->back()->with('message' , 'Order Confirmed Successfully');
    }
}

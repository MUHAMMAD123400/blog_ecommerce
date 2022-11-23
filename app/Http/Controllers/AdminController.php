<?php

namespace App\Http\Controllers;

use Illuminate\Http\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    //
    public function products(){
        if(Auth::id()){
            if (Auth::user()->usertype == '1') {
                return view('admin.product');
            }else{
                return redirect()->back();
            }
        }else{
            return redirect('login');
        }
    }

    public function uploadproduct(Request $req){
        $data = new Product();

        $image = $req->file;
        $img_name = $image->getClientOriginalName();
        $req->file->move('productimages' , $img_name);

        $data->image = $img_name;
        $data->title = $req->title;
        $data->price = $req->price;
        $data->description = $req->des;
        $data->quantity = $req->quantity;
        $data->save();
        return redirect()->back()->with('message' , 'Product Add Successfully');
    }

    public function showproducts(){
        $data = Product::all();
        return view('admin.showproduct' , compact('data'));
    }

    public function deleteproducts($id){
        $data = Product::find($id);
        $data->delete();
        return redirect()->back()->with('message' , 'Product Delete Successfully');
    }

    public function updateproducts($id){
        $data = Product::find($id);
        return view('admin.update' , compact('data'));
    }

    public function updateproduct(Request $req){
        $data = Product::find($req->id);
        $image = $req->file;
        if ($image) {
            $img_name = $image->getClientOriginalName();
            $req->file->move('productimages' , $img_name);
            $data->image = $img_name;
        }
        $data->title = $req->title;
        $data->price = $req->price;
        $data->description = $req->des;
        $data->quantity = $req->quantity;
        $data->save();
        return redirect()->back()->with('message' , 'Product Update Successfully');
    }

    public function showorder(){
        $order = Order::all();
        return view('admin.showorder' , compact('order'));
    }

    public function updatestatus($id){
        $order = Order::find($id);
        $order->status = 'delivered';
        $order->save();
        return redirect()->back();
    }
}

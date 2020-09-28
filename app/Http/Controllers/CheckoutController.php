<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\Shipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function getCheckout(){
        if (Auth::check()){
            $menus = Menu::all();
            return view('pages.checkout',['menus'=>$menus]);
        }
        else{
            return redirect('login');
        }
    }
    public function postCheckout(Request $request){
        $this->validate($request,
            [
                'email'=> 'required',
                'name'=> 'required',
                'address'=> 'required',
                'phone'=> 'required',
            ],
            [
                'email.required' => 'please enter email',
                'name.required' => 'please enter name',
                'address.required' => 'please enter address',
                'phone.required' => 'please enter phone number',
            ]
        );
        $shipping = new Shipping();
        $shipping->email = $request->email;
        $shipping->name = $request->name;
        $shipping->address = $request->address;
        $shipping->phoneNumber = $request->phone;
        $shipping->note = $request->note;
        $shipping->idUser = Auth::user()->id;
        $shipping->save();
        //save order
        foreach (Cart::content() as $cart){
            $order = new Order();
            $order->idProduct = $cart->id;
            $order->idShipping = $shipping->id;
            $order->quanity = $cart->qty;
            $order->total = Cart::total();
            $order->save();

            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $cart->id;
            $orderDetail->product_name = $cart->name;
            $orderDetail->price = $cart->price;
            $orderDetail->quanity = $cart->qty;
            $orderDetail->save();

            //Edit Product number quanity
            $product = Product::find($cart->id);
            $product->stock = $product->stock -$cart->qty;
            $product->save();
        }

       Cart::destroy();
        return redirect('index');
    }
    public function getShipping($id){
        $order = Order::find($id);
        return view('admin.pages.shipping.view-order',['order'=>$order]);
    }
}

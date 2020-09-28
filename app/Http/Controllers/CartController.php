<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function getCart(){
        $menus = Menu::all();
        return view('pages.cart',['menus'=>$menus]);
    }
    public function postCart(Request $request){
        $id = $request->idProduct;
        $product = Product::find($id);
        $data['id'] = $product->id;
        $data['qty'] = 1;
        $data['name'] = $product->name;
        $data['price'] = $product->price;
        $data['weight'] = $product->price;
        $data['options']['image'] = $product->img;
        Cart::add($data);
        $menus = Menu::all();
        return view('pages.cart',['menus'=>$menus]);
    }
    public  function deleteCart($id){
        Cart::remove($id);
        $menus = Menu::all();
        return view('pages.cart',['menus'=>$menus]);
    }
    public function updateCart($id,Request $request){
        $qty = $request->qty;
        Cart::update($id, $qty);
        return redirect('cart');
    }
}

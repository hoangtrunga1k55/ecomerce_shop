<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function getList(){
        $orders = Order::all();
        return view('admin.pages.shipping.list',['orders'=>$orders]);
    }
}

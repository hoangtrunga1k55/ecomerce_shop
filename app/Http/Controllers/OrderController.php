<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getList(){
        return view('admin.pages.order.list');
    }
    public function getAdd(){
        return view('admin.pages.order.add');
    }
}

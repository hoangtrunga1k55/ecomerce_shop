<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Latest;
use App\Product;

class LatestProductController extends Controller
{
    public function getList(){
        $latest = Latest::find(2);
        return view('admin.pages.latest.list',['latests'=>$latest]);
    }
    public function getAdd(){
        $products = Product::all()->where('id_feature_latest','!=',2);
        return view('admin.pages.latest.add',['products'=>$products]);
    }
    public function getDelete($id){
        $product = Product::find($id);
        $product->id_feature_latest = 0;
        $product->save();
        return redirect('admin/latest/list/')->with('thongbao','xoa thanh cong');
    }
    public function postAdd(Request $request ){
        $id = $request->id;
        $product = Product::find($id);
        $product->id_feature_latest = 2;
        $product->save();
        return redirect('admin/latest/list')->with('message', 'Register Sussessful');
    }
}

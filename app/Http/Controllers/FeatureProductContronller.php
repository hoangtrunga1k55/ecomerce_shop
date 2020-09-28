<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Feature;
use App\Product;

class FeatureProductContronller extends Controller
{
    public function getList(){
        $features = Feature::find(1);
        return view('admin.pages.feature.list',['features'=>$features]);
    }
    public function getAdd(){
        $products = Product::all()->where('id_feature_latest','!=',1);
        return view('admin.pages.feature.add',['products'=> $products]);
    }
    public function getDelete($idProduct){
        $product = Product::find($idProduct);
        $product->id_feature_latest = 0;
        $product->save();
        return redirect('admin/feature/list/')->with('thongbao','xoa thanh cong');
    }
    public function postAdd(Request $request ){
        $id = $request->id;
        $product = Product::find($id);
        $product->id_feature_latest = 1;
        $product->save();
        return redirect('admin/feature/list')->with('message', 'Register Sussessful');
    }
}

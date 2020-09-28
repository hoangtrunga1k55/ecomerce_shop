<?php

namespace App\Http\Controllers;

use App\Product;
use App\Size;
use App\User;
use Illuminate\Http\Request;
use App\Manage;

class ManageController extends Controller
{
    public function getList(){
        $manages = Manage::all();
        return view('admin.pages.manage.list',['manages'=>$manages,'i'=>1]);
    }
    public function getAdd(){
        $products = Product::all();
        $sizes = Size::all();
        return view('admin.pages.manage.add',['products'=>$products,'sizes'=>$sizes]);
    }
    public function getEdit($id){
        $manage = Manage::find($id);
        return view('admin.pages.manage.edit',['manage'=>$manage]);
    }
    public function getDelete($id){
        $manage = Manage::find($id);
        $manage->delete();
        return redirect('admin/manage/list/')->with('thongbao','xoa thanh cong');
    }
    public function postAdd(Request $request ){
        $this->validate($request,
            [
                'quanity'=> 'required',
            ],
            [
                'quanity.required' => 'ban chua nhap quanity',
            ]
        );
        $manage = new Manage();
        $manage->idProduct = $request->idProduct;
        $manage->idSize = $request->idSize;
        $manage->quanity = $request->quanity;
        $manage->save();
        return redirect('admin/manage/list')->with('message', 'Register Sussessful');
    }
    public function postEdit(Request $request, $id){
        $this->validate($request,
            [
                'quanity'=> 'required',
            ],
            [
                'quanity.required' => 'ban chua nhap quanity',
            ]
        );
        $manage = Manage::all()->find($id);
        $manage->idProduct = $request->idProduct;
        $manage->idSize = $request->idSize;
        $manage->quanity = $request->quanity;
        $manage->save();
        return redirect('admin/manage/list')->with('message', 'Register Sussessful');
    }
}

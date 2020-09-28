<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Size;

class SizeController extends Controller
{
    public function getList(){
        $sizes = Size::all();
        return view('admin.pages.size.list',['sizes'=>$sizes]);
    }
    public function getAdd(){
        return view('admin.pages.size.add');
    }
    public function getEdit($id){
        $size = Size::find($id);
        return view('admin.pages.size.edit',['size'=>$size]);
    }
    public function getDelete($id){
        $size = Size::find($id);
        $size->delete();
        return redirect('admin/size/list/')->with('thongbao','xoa thanh cong');
    }
    public function postAdd(Request $request ){
        $this->validate($request,
            [
                'name'=> 'required',
            ],
            [
                'name.required' => 'ban chua nhap name',
            ]
        );
        $size = new Size();
        $size->nameOfSize = $request->name;
        $size->save();
        return redirect('admin/size/list')->with('message', 'Register Sussessful');
    }
    public function postEdit(Request $request, $id){
        $this->validate($request,
            [
                'name'=> 'required',
            ],
            [
                'name.required' => 'ban chua nhap title',
            ]
        );
        $size = Size::all()->find($id);
        $size->nameOfSize = $request->name;
        $size->save();
        return redirect('admin/size/list')->with('message', 'Register Sussessful');
    }
}

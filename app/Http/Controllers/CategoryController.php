<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function getList(){
        $categorys = Category::all();
        return view('admin.pages.category.list',['categorys'=>$categorys]);
    }
    public function getAdd(){
        return view('admin.pages.category.add');
    }
    public function getEdit($id){
        $category = Category::find($id);
        return view('admin.pages.category.edit',['category'=>$category]);
    }
    public function getDelete($id){
        $category = Category::find($id);
        $category->delete();
        return redirect('admin/category/list/')->with('thongbao','xoa thanh cong');
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
        $category = new category();
        $category->name = $request->name;
        $category->save();
        return redirect('admin/category/list')->with('message', 'Register Sussessful');
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
        $category = Category::all()->find($id);
        $category->name = $request->name;
        $category->save();
        return redirect('admin/category/list')->with('message', 'Register Sussessful');
    }
}

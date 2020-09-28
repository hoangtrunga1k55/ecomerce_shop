<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Menu;
use App\SubMenu;

class MenuController extends Controller
{
    public function getList(){
        $menus = Menu::all();
        return view('admin.pages.menu.list',['menus'=>$menus]);
    }
    public function getAdd(){
        $menus = Menu::all();
        return view('admin.pages.menu.add',['menus'=>$menus]);
    }
    public function getEdit($id){
        $menuu = Menu::find($id);
        $menus = Menu::all();
        return view('admin.pages.menu.edit',['menuu'=>$menuu,'menus'=>$menus]);
    }
    public function getDelete($id){
        $menu = Menu::find($id);
        $menu->delete();
        return redirect('admin/menu/list/')->with('thongbao','xoa thanh cong');
    }
    public function postAdd(Request $request ){
        $this->validate($request,
            [
                'name'=> 'required',
                'slug'=>'required',
            ],
            [
                'name.required' => 'ban chua nhap name',
                'slug.required' => 'ban chua nhap name'
            ]
        );
        $menu = new Menu();
        $menu->name = $request->name;
        $menu->slug = $request->slug;
        $menu->save();
        return redirect('admin/menu/list')->with('message', 'Register Sussessful');
    }
    public function postEdit(Request $request, $id){
        $this->validate($request,
            [
                'name'=> 'required',
                'slug'=>'required',
            ],
            [
                'name.required' => 'ban chua nhap name',
                'slug.required' => 'ban chua nhap name'
            ]
        );
        $menu = Menu::all()->find($id);
        $menu->name = $request->name;
        $menu->slug = $request->slug;
        $menu->save();
        return redirect('admin/menu/list')->with('message', 'Register Sussessful');
    }
    public  function  getAddChildMenu($id){
        return view('admin.pages.menu.add_child',['parent'=>$id]);
    }
    public  function  postAddChildMenu(Request $request, $id){
        $menu = new Menu();
        $menu->name = $request->name;
        $menu->slug = $request->slug;
        $menu->idParent = $id;
        $menu->save();
        return redirect('admin/menu/list');
    }
}

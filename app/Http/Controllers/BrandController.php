<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Brand;

class BrandController extends Controller
{
    public function RandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $length; $i++) {
            $randstring= $randstring.''.$characters[rand(0,60)];
        }
        return $randstring;
    }
    public function getList(){
        $brands = Brand::all();
        return view('admin.pages.brand.list',['brands'=>$brands]);
    }
    public function getAdd(){
        return view('admin.pages.brand.add');
    }
    public function getEdit($id){
        $brand = Brand::find($id);
        return view('admin.pages.brand.edit',['brand'=>$brand]);
    }
    public function getDelete($id){
        $brand = Brand::find($id);
        $brand->delete();
        return redirect('admin/brand/list/')->with('thongbao','xoa thanh cong');
    }
    public function postAdd(Request $request ){
        $this->validate($request,
            [
                'description'=> 'required',
                'image'=> 'required',
            ],
            [
                'description.required' => 'ban chua nhap description',
                'image.required' => 'ban chua nhap image'
            ]
        );
        $brand = new Brand();
        $brand->description = $request->description;
        if ($request->hasFile('image')){
            $file = $request->file('image');
            if ($file->getClientOriginalExtension()!='jpg'&&$file->getClientOriginalExtension()!='png'){
                return redirect('admin/brand/add')->with('loi','ban chi duoc nhap file anh');
            }
            else{
                $name = $file->getClientOriginalName();
                $Hinh = $this->RandomString(4)."_".$name;
                while (file_exists("images/brand/".$Hinh)){
                    $Hinh = $this->RandomString(4)."_".$Hinh;
                }
                $file->move('images/brand/',$Hinh);
                $brand->img = 'images/brand/'.$Hinh;
            }

        }else{
            $brand->img = '';
        }
        $brand->save();
        return redirect('admin/brand/list')->with('message', 'Register Sussessful');
    }
    public function postEdit(Request $request, $id){
        $this->validate($request,
            [
                'description'=> 'required',
                'image'=> 'required',
            ],
            [
                'description.required' => 'ban chua nhap description',
                'image.required' => 'ban chua nhap image'
            ]
        );
        $brand = Brand::all()->find($id);
        $brand->description = $request->description;
        if ($request->hasFile('image')){
            $file = $request->file('image');
            if ($file->getClientOriginalExtension()!='jpg'&&$file->getClientOriginalExtension()!='png'){
                return redirect('admin/brand/add')->with('loi','ban chi duoc nhap file anh');
            }
            else{
                $name = $file->getClientOriginalName();
                $Hinh = $this->RandomString(4)."_".$name;
                while (file_exists("images/brand/".$Hinh)){
                    $Hinh = $this->RandomString(4)."_".$Hinh;
                }
                $file->move('images/brand',$Hinh);
                $brand->img = 'images/brand/'.$Hinh;
            }

        }else{
            $brand->img = '';
        }
        $brand->save();
        return redirect('admin/brand/list')->with('message', 'Register Sussessful');
    }
}

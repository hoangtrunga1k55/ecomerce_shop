<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Banner;

class BannerController extends Controller
{
    public function RandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $length; $i++) {
            $randstring = $characters[rand(0,60)];
        }
        return $randstring;
    }
    public function getList(){
        $banners = Banner::all();
        return view('admin.pages.banner.list',['banners'=>$banners]);
    }
    public function getAdd(){
        return view('admin.pages.banner.add');
    }
    public function getEdit($id){
        $banner = Banner::find($id);
        return view('admin.pages.banner.edit',['banner'=>$banner]);
    }
    public function getDelete($id){
        $banner = Banner::find($id);
        $banner->delete();
        return redirect('admin/banner/list/')->with('thongbao','xoa thanh cong');
    }
    public function postAdd(Request $request ){
        $this->validate($request,
            [
                'title'=> 'required',
                'description'=> 'required',
                'image'=> 'required',
            ],
            [
                'title.required' => 'ban chua nhap title',
                'description.required' => 'ban chua nhap description',
                'image.required' => 'ban chua nhap image'
            ]
        );
        $banner = new Banner();
        $banner->title = $request->title;
        $banner->description = $request->description;
        if ($request->hasFile('image')){
            $file = $request->file('image');
            if ($file->getClientOriginalExtension()!='jpg'&&$file->getClientOriginalExtension()!='png'){
                return redirect('admin/banner/add')->with('loi','ban chi duoc nhap file anh');
            }
            else{
                $name = $file->getClientOriginalName();
                $Hinh = $this->RandomString(4)."_".$name;
                while (file_exists("images/".$Hinh)){
                    $Hinh = $this->RandomString(4)."_".$Hinh;
                }
                $file->move('images',$Hinh);
                $banner->img = 'images/'.$Hinh;
            }

        }else{
            $banner->img = '';
        }
        $banner->save();
        return redirect('admin/banner/list')->with('message', 'Register Sussessful');
    }
    public function postEdit(Request $request, $id){
        $this->validate($request,
            [
                'title'=> 'required',
                'description'=> 'required',
                'image'=> 'required',
            ],
            [
                'title.required' => 'ban chua nhap title',
                'description.required' => 'ban chua nhap description',
                'image.required' => 'ban chua nhap image'
            ]
        );
        $banner = Banner::all()->find($id);
        $banner->title = $request->title;
        $banner->description = $request->description;
        if ($request->hasFile('image')){
            $file = $request->file('image');
            if ($file->getClientOriginalExtension()!='jpg'&&$file->getClientOriginalExtension()!='png'){
                return redirect('admin/banner/add')->with('loi','ban chi duoc nhap file anh');
            }
            else{
                $name = $file->getClientOriginalName();
                $Hinh = $this->RandomString(4)."_".$name;
                while (file_exists("images/".$Hinh)){
                    $Hinh = $this->RandomString(4)."_".$Hinh;
                }
                $file->move('images',$Hinh);
                $banner->img = 'images/'.$Hinh;
            }

        }else{
            $banner->img = '';
        }
        $banner->save();
        return redirect('admin/banner/list')->with('message', 'Register Sussessful');
    }
}

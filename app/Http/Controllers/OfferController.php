<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Offer;

class OfferController extends Controller
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
        $offers = Offer::all();
        return view('admin.pages.offer.list',['offers'=>$offers]);
    }
    public function getAdd(){
        return view('admin.pages.offer.add');
    }
    public function getEdit($id){
        $offer = Offer::find($id);
        return view('admin.pages.offer.edit',['offer'=>$offer]);
    }
    public function getDelete($id){
        $offer = Offer::find($id);
        $offer->delete();
        return redirect('admin/offer/list/')->with('thongbao','xoa thanh cong');
    }
    public function postAdd(Request $request ){
        $this->validate($request,
            [
                'fdescription'=>'required',
                'title'=> 'required',
                'description'=> 'required',
                'image'=> 'required',
            ],
            [
                'fdescription.required' => 'ban chua nhap first description',
                'title.required' => 'ban chua nhap title',
                'description.required' => 'ban chua nhap description',
                'image.required' => 'ban chua nhap image'
            ]
        );
        $offer = new Offer();
        $offer->fdescription = $request->fdescription;
        $offer->title = $request->title;
        $offer->description = $request->description;
        if ($request->hasFile('image')){
            $file = $request->file('image');
            if ($file->getClientOriginalExtension()!='jpg'&&$file->getClientOriginalExtension()!='png'){
                return redirect('admin/offer/add')->with('loi','ban chi duoc nhap file anh');
            }
            else{
                $name = $file->getClientOriginalName();
                $Hinh = $this->RandomString(4)."_".$name;
                while (file_exists("images/offer/".$Hinh)){
                    $Hinh = $this->RandomString(4)."_".$Hinh;
                }
                $file->move('images/offer',$Hinh);
                $offer->img = 'images/offer/'.$Hinh;
            }

        }else{
            $offer->img = '';
        }
        $offer->save();
        return redirect('admin/offer/list')->with('message', 'Register Sussessful');
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
        $offer = Offer::all()->find($id);
        $offer->fdescription = $request->fdescription;
        $offer->title = $request->title;
        $offer->description = $request->description;
        if ($request->hasFile('image')){
            $file = $request->file('image');
            if ($file->getClientOriginalExtension()!='jpg'&&$file->getClientOriginalExtension()!='png'){
                return redirect('admin/offer/add')->with('loi','ban chi duoc nhap file anh');
            }
            else{
                $name = $file->getClientOriginalName();
                $Hinh = $this->RandomString(4)."_".$name;
                while (file_exists("images/offer".$Hinh)){
                    $Hinh = $this->RandomString(4)."_".$Hinh;
                }
                $file->move('images/offer/',$Hinh);
                $offer->img = 'images/offer/'.$Hinh;
            }

        }else{
            $offer->img = '';
        }
        $offer->save();
        return redirect('admin/offer/list')->with('message', 'Register Sussessful');
    }
}

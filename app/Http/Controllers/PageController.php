<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Feature;
use App\Menu;
use App\Product;
use App\Testimonial;
use Illuminate\Http\Request;
use App\Customer;
use App\User;
use App\Banner;
use App\Latest;
use Illuminate\Support\Facades\Auth;
use App\Offer;

class PageController extends Controller
{
public function  getRegister(){
    return view('pages.register');
}
    public function  getLogin(){
    $menus = Menu::all();
        return view('pages.login',['menus'=>$menus]);
    }
public function postLogin(Request  $request){
    $this->validate($request,
        [
            'email' => 'required',
            'password' => 'required|min:3|max:32',
        ], [
            'email.required' => 'ban chua nhap email',
            'password.required' => 'ban chua nhap password',
            'password.min' => 'password min la 3',
            'password.max' => 'password max la 32'
        ]);

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password,'role'=>1])) {
        $menus = Menu::all();
        return redirect('index');
    } else {
        return redirect('login')->with('message', 'dang nhap khong thanh cong');
    }
}
public function postRegister(Request  $request){
    $this->validate($request,
        [
            'name'=> 'required|min:3|max:30',
            'email'=> 'required|min:8|max:25|unique:tbl_customer,email',
            'password'=> 'required|min:8|max:20',
        ],
        [
            'name.required' => 'ban chua nhap ten',
            'name.min' =>' name phai lon hon 3 ky tu',
            'name.max' =>' name phai nho hon 30 ky tu',
            'password.required' => 'ban chua nhap password',
            'password.min' =>' password phai lon hon 3 ky tu',
            'password.max' =>' password phai nho hon 20 ky tu',
            'email.required' => 'ban chua nhap email',
            'email.min' =>' email phai lon hon 3 ky tu',
            'email.max' =>' email phai nho hon 20 ky tu',
            'email.unique' =>' email phai duy nhat'
        ]
    );
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->save();
    return redirect('index')->with('message','Register Sussessful');
}
    public function getLogout()
    {
        Auth::logout();
        return redirect('index');
    }
    public function getBanner(){
            $banner = Banner::all()->where('active','=',1)->first;
            $banner = $banner->getAttributes();
            $feature = Feature::find(1);
             $latest = Latest::find(2);
             $offer = Offer::all()->first();
            $brands = Brand::all();
            $testimonials = Testimonial::all();
            $menus = Menu::all();
            return view('pages.index',['banner'=>$banner,'feature'=>$feature,'latest'=>$latest,'offer'=>$offer,'brands'=>$brands,'testimonials'=>$testimonials,'menus'=>$menus]);
    }
    public function  getProductDetail($id){
        $product = Product::find($id);
        $relate = Feature::find(1);
        $menus = Menu::all();
        return view('pages.product_detail',['product'=>$product,'relate'=>$relate,'menus'=>$menus]);
    }
}

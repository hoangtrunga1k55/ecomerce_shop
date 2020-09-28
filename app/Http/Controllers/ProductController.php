<?php

namespace App\Http\Controllers;

use App\Menu;
use App\User;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    function __construct()
    {
        $products = Product::all();
        $menus = Menu::all();
        view()->share('products',$products);
        view()->share('$menus',$menus);

    }

    public function RandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $length; $i++) {
            $randstring =$randstring.''.$characters[rand(0,60)];
        }
        return $randstring;
    }
    public function getList(){
        $products = Product::all();
        return view('admin.pages.product.list',['products'=>$products]);
    }
    public function getAdd(){
        $menus = Menu::all();
        return view('admin.pages.product.add',['menus'=>$menus]);
    }
    public function getEdit($id){
        $product = Product::find($id);
        return view('admin.pages.product.edit',['product'=>$product]);
    }
    public function getDelete($id){
        $product = Product::find($id);
        $product->delete();
        return redirect('admin/product/list/')->with('thongbao','xoa thanh cong');
    }
    public function postAdd(Request $request ){
        $this->validate($request,
            [
                'name'=> 'required',
                'price'=> 'required',
                'stock'=> 'required',
                'image'=> 'required',
            ],
            [
                'name.required' => 'ban chua nhap name',
                'price.required' => 'ban chua nhap price',
                'stock.required' => 'ban chua nhap stock',
                'image.required' => 'ban chua nhap image',
            ]
        );
        $idMenus = $request->idMenu;
        if ($request->hasFile('image')){
            $file = $request->file('image');
            if ($file->getClientOriginalExtension()!='jpg'&&$file->getClientOriginalExtension()!='png'){
                return redirect('admin/product/add')->with('loi','ban chi duoc nhap file anh');
            }
            else{
                $name = $file->getClientOriginalName();
                $Hinh = $this->RandomString(4)."_".$name;
                while (file_exists("images/product/".$Hinh)){
                    $Hinh = $this->RandomString(4)."_".$Hinh;
                }
                $file->move('images/product/',$Hinh);
                $image= 'images/product/'.$Hinh;
            }
        }else{
            $image = '';
        }
       foreach ($idMenus as $idMenu){
           $product = new Product();
           $product->name = $request->name;
           $product->price = $request->price;
           $product->stock = $request->stock;
           $product->description = $request->description;
           $product->active = $request->active;
           $product->id_menu = $idMenu;
            $product->img = $image;
           $product->save();
       }
        return redirect('admin/product/list')->with('message', 'Register Sussessful');
    }
    public function postEdit(Request $request, $id){
        $this->validate($request,
            [
                'name'=> 'required',
                'price'=> 'required',
                'stock'=> 'required',
                'image'=> 'required',
            ],
            [
                'name.required' => 'ban chua nhap name',
                'price.required' => 'ban chua nhap price',
                'stock.required' => 'ban chua nhap stock',
                'image.required' => 'ban chua nhap image',
            ]
        );
        $product = Product::all()->find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->active = $request->active;
        if ($request->hasFile('image')){
            $file = $request->file('image');
            if ($file->getClientOriginalExtension()!='jpg'&&$file->getClientOriginalExtension()!='png'){
                return redirect('admin/product/add')->with('loi','ban chi duoc nhap file anh');
            }
            else{
                $name = $file->getClientOriginalName();
                $Hinh = $this->RandomString(4)."_".$name;
                while (file_exists("images/".$Hinh)){
                    $Hinh = $this->RandomString(4)."_".$Hinh;
                }
                $file->move('images',$Hinh);
                $product->img = 'images/'.$Hinh;
            }

        }else{
            $product->img = '';
        }
        $product->save();
        return redirect('admin/product/list')->with('message', 'Register Sussessful');
    }
    public  function  getProduct(){
        $products = Product::all()->take(12);
        $menus = Menu::all();
        return view('pages.product',['products'=>$products,'menus'=>$menus]);
    }
    public  function getTopProduct($id){
        $menus = Menu::all();
        $listProduct = [];
        if (Menu::find($id)->idParent!=0){
            $products = Product::all()->where('id_menu','=',$id);
            foreach ($products as $product){
                if (isset($product->id)){
                    array_push($listProduct,$product);
                }
            }
        }
        foreach ($menus as $menu){
            if ($id==$menu->idParent){
                $products = Product::all()->where('id_menu','=',$menu->id);
                foreach ($products as $product){
                    if (isset($product->id)){
                        array_push($listProduct,$product);
                    }
                }
            }
        }
        return view('pages.bottom',['products'=>$listProduct,'menus'=>$menus]);
    }
    public  function getBottomProduct($id){
        $menus = Menu::all();
        $listProduct = [];
        if (Menu::find($id)->idParent!=0){
            $products = Product::all()->where('id_menu','=',$id);
            foreach ($products as $product){
                if (isset($product->id)){
                    array_push($listProduct,$product);
                }
            }
        }
        foreach ($menus as $menu){
            if ($id==$menu->idParent){
                $products = Product::all()->where('id_menu','=',$menu->id);
                foreach ($products as $product){
                    if (isset($product->id)){
                        array_push($listProduct,$product);
                    }
                }
            }
        }
        return view('pages.bottom',['products'=>$listProduct,'menus'=>$menus]);
    }
    public  function getJacketProduct($id){
        $menus = Menu::all();
        if (Menu::find($id)->idParent!=0){
            $products = Product::all()->where('id_menu','=',$id);
        }
        return view('pages.jacket',['products'=>$products,'menus'=>$menus]);
    }
    public  function getHoddiesProduct($id){
        $menus = Menu::all();
        if (Menu::find($id)->idParent!=0){
            $products = Product::all()->where('id_menu','=',$id);
        }
        return view('pages.hoddies',['products'=>$products,'menus'=>$menus]);
    }
    public  function getTshirtProduct($id){
        $menus = Menu::all();
        if (Menu::find($id)->idParent!=0){
            $products = Product::all()->where('id_menu','=',$id);
        }
        return view('pages.tshirt',['products'=>$products,'menus'=>$menus]);
    }
}

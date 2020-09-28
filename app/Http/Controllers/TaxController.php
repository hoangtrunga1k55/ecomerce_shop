<?php

namespace App\Http\Controllers;

use App\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function getList(){
        $taxs = Tax::all();
        return view('admin.pages.tax.list',['taxs'=>$taxs]);
    }
    public function getAdd(){
        return view('admin.pages.tax.add');
    }
    public function getEdit($id){
        $tax = Tax::find($id);
        return view('admin.pages.tax.edit',['tax'=>$tax]);
    }
    public function postAdd(Request $request){
        $this->validate($request,
            [
                'name'=> 'required',
                'price'=>'required'
            ],
            [
                'name.required' => 'ban chua nhap name',
                'price.required' => 'ban chua nhap tax',
            ]
        );
        $tax = new Tax();
        $tax->name = $request->name;
        $tax->price = $request->price;
        $tax->save();
        return redirect('admin/tax/list');
    }
    public function postEdit(Request $request, $id){
        $this->validate($request,
            [
                'name'=> 'required',
                'price'=>'required'
            ],
            [
                'name.required' => 'ban chua nhap name',
                'price.required' => 'ban chua nhap tax',
            ]
        );
        $tax = Tax::all()->find($id);
        $tax->name = $request->name;
        $tax->price = $request->price;
        $tax->save();
        return redirect('admin/tax/list');
    }
    public function getDelete($id){
        $tax = Tax::find($id);
        $tax->delete();
        return redirect('admin/tax/list/')->with('thongbao','xoa thanh cong');
    }
}

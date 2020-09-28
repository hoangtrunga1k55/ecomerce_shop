<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Testimonial;

class TestimonialController extends Controller
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
        $testimonials = Testimonial::all();
        return view('admin.pages.testimonial.list',['testimonials'=>$testimonials]);
    }
    public function getAdd(){
        return view('admin.pages.testimonial.add');
    }
    public function getEdit($id){
        $testimonial = Testimonial::find($id);
        return view('admin.pages.testimonial.edit',['testimonial'=>$testimonial]);
    }
    public function getDelete($id){
        $testimonial = Testimonial::find($id);
        $testimonial->delete();
        return redirect('admin/testimonial/list/')->with('thongbao','xoa thanh cong');
    }
    public function postAdd(Request $request ){
        $this->validate($request,
            [
                'contentt'=> 'required',
                'numberOfStar'=> 'required',
                'idUser'=> 'required',
            ],
            [
                'contentt.required' => 'ban chua nhap noi dung',
                'numberOfStar.required' => 'ban chua nhap danh gia sao',
                'idUser.required' => 'ban chua nhap user'
            ]
        );
        $testimonial = new Testimonial();
        $testimonial->content = $request->contentt;
        $testimonial->numberOfStar = $request->numberOfStar;
        $testimonial->idUser = $request->idUser;
        $testimonial->save();
        return redirect('admin/testimonial/list')->with('message', 'Register Sussessful');
    }
    public function postEdit(Request $request, $id){
        $this->validate($request,
            [
                'content'=> 'required',
                'numberOfStar'=> 'required',
                'idUser'=> 'required',
            ],
            [
                'content.required' => 'ban chua nhap content',
                'numberOfStar.required' => 'ban chua nhap danh gia sao',
                'idUser.required' => 'ban chua nhap nguoi dung'
            ]
        );
        $testimonial = Testimonial::all()->find($id);
        $testimonial->content = $request->contentt;
        $testimonial->numberOfStar = $request->numberOfStar;
        $testimonial->idUser = $request->idUser;
        $testimonial->save();
        return redirect('admin/testimonial/list')->with('message', 'Register Sussessful');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getList(){
        $users = DB::table('users')->get();
        return view('admin.pages.user.list',['users'=>$users]);
    }
    public function getAdd(){
        return view('admin.pages.user.add');
    }
    public function getEdit($id){
        $user = User::find($id);
        return view('admin.pages.user.edit',['user'=>$user]);
    }
    public function postEdit(Request  $request,$id){
        $user = User::find($id);
        $this->validate($request,
            [
                'name'=> 'required|min:3|max:30',
                'email'=> 'required|min:8|max:200',
                'password'=> 'required|min:8|max:200',
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
            ]
        );
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('admin/user/list')->with('message', 'Edit Sussessful');
    }
    public function getDelete($id){
        $user = User::find($id);
        $user->delete();
        return redirect('admin/user/list/')->with('thongbao','xoa thanh cong');
    }
    public function postAdd(Request $request ){
        $this->validate($request,
            [
                'name'=> 'required|min:3|max:30',
                'email'=> 'required|min:8|max:200|unique:users,email',
                'password'=> 'required|min:8|max:200',
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
        return redirect('admin/user/list')->with('message', 'Register Sussessful');
    }
}

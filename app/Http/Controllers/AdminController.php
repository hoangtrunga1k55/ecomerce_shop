<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public  function postLogin(Request  $request){
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

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password,'role'=>'1'])) {
            return redirect('admin/index');
        } else {
            return redirect('admin/login')->with('thongbao', 'dang nhap khong thanh cong');
        }
    }
    public function getLogout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}

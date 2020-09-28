<?php

namespace App\Http\Controllers;

use App\Student;
use App\Video;
use FFMpeg\FFMpeg;
use Illuminate\Http\Request;

class InternController extends Controller
{
    public function index(){
        return view('Intern.form');
    }
    public function convert(){
        return view('convert_to_mp4');
    }
    public function postData(Request $request){
        if ($request->hasFile('img')){
            $file = $request->file('img');
            if ($file->getClientOriginalExtension()!='jpg'&&$file->getClientOriginalExtension()!='png'){
                return redirect('admin/product/add')->with('loi','ban chi duoc nhap file anh');
            }
            else{
                $name = $file->getClientOriginalName();
                $file->move('images/product/',$name);
                $image= 'images/product/'.$name;
            }
        }else{
            $image = '';
        }
        $student = new Student();
        $student->fname = $request->fname;
        $student->lname = $request->lname;
        $student->name = $request->uname;
        $student->password = $request->pwd;
         $student->email = $request->email;
        $student->address = $request->address;
        $student->colleges = $request->colleges;
        $student->img = $image;
        $student->save();
        return redirect('intern');
    }
    public function convertToMP4(Request $request){
        $data = new Video();
        $files = $request->file('img');
        $file_arr_type = ['mp4','ogg','mpeg4','avi','mov','mpg','wmv','flv','webm','mkv','ogv','3gp','3g2'];
        $basename = basename($files->getClientOriginalName(),$files->getClientOriginalExtension());
        $file_type = strtolower($files->getClientOriginalExtension());
        $name = $files->getClientOriginalName();
        if (in_array($file_type, $file_arr_type)) {
            if ($file_type != 'mp4') {
                $ffmpeg = FFMpeg::create();
                $linkk = '/home/hoangtrung/Desktop/'.$name;
                $video = $ffmpeg->open($linkk);
                $format = new \FFMpeg\Format\Video\X264();
                $format->setAudioCodec("libmp3lame");
                $video->save($format,'video/'.$basename.'mp4');
                $data->link = 'video/'.$name;
            } else {
                $files->move('video',$name);
                $data->link = 'video/'.$name;
            }
            $data->save();
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class HomeController extends Controller
{
public function action(Request $request){
    /* Getting file name */
    $filename = $_FILES['file']['name'];
    /* Location */
    $target = "images/api/";
    $location = "images/api/".$filename;
    $uploadOk = 1;
    $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
    /* Valid extensions */
    $valid_extensions = array("jpg","jpeg","png");

    /* Check file extension */
    if(!in_array(strtolower($imageFileType), $valid_extensions)) {
        $uploadOk = 0;
    }

    if($uploadOk == 0){
        echo 0;
    }else{
        /* Upload file */
        if(move_uploaded_file($_FILES['file']['tmp_name'],$target)){
            echo $location;
        }else{
            echo 0;
        }
    }
}
// post
    public function postData(Request $request)
    {
        $filename = $_FILES['file']['name'];
        /* Location */
        $location = "images/api/".$filename;
        $target = "images/api";
        $uploadOk = 1;
        $imageFileType = pathinfo($location,PATHINFO_EXTENSION);

        /* Valid extensions */
        $valid_extensions = array("jpg","jpeg","png");

        /* Check file extension */
        if(!in_array(strtolower($imageFileType), $valid_extensions)) {
            $uploadOk = 0;
        }
        if($uploadOk == 0){
            return 1;
        }else{
            /* Upload file */
            if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                if ($request->id !=0){
                    $id = $request->id;
                    $url= 'http://127.0.0.1:8001/api/user/'.$id;
                    $datas = Curl::to($url)->get();
                    $datas = json_decode($datas);
                    $img = $datas->data->img;
                    unlink($img);
                    $responses = Curl::to($url)
                        ->withData(['name'=>$request->name, 'email'=>$request->email,'img'=>$location])
                        ->put();
                }
                else{
                    $responses = Curl::to('http://127.0.0.1:8001/api/user/add')
                        ->withData(['name'=>$request->name,'email'=>$request->email,'img'=>$location])
                        ->post();
                    $responses = json_decode($responses);
                    foreach ($responses as $response){
                        $id  = $response->id;
                    }
                }
                return response()->json(['data' => ['name'=>$request->name, 'email'=>$request->email,'id'=>$id,'img'=>$location]]);
            }else{
                return 0;
            }
        }
    }
    //get Data
    public function getData()
    {
        $response = Curl::to('http://127.0.0.1:8001/api/listUser')
            ->get();
        $response = json_decode($response);
        return view('api',['responses'=>$response]);
    }
    //put
    public function editData(Request $request,$id)
    {
        $url = 'http://127.0.0.1:8001/api/user/'.$id;
        $responses = Curl::to($url)->get();
        $responses = json_decode($responses);
        return response()->json(['data' => ['name'=>$responses->data->name, 'email'=>$responses->data->email,'id'=>$id,'img'=>$responses->data->img]]);
    }

//delete
    public function deleteData($id)
    {
        $url = 'http://127.0.0.1:8001/api/user/'.$id;
        $datas = Curl::to($url)->get();
        $datas = json_decode($datas);
        $img = $datas->data->img;
        unlink($img);
        $response = Curl::to($url)
            ->delete();
        dd($response);
    }
}

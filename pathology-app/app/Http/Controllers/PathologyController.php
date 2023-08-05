<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use \app\models\PathologyReports;

class PathologyController extends Controller
{
    //
    public function index(){        
        $model = ['hn'=>'000088973', 'fname'=>'Laravel', 'lname'=>'version 10','age'=>'30','gender'=>'F','cdate'=>'23 ก.ค. 2566' ,'srdate'=>'23 ก.ค. 2566' ,'rdate'=>'23 ก.ค. 2566','doctor'=>'Dr. Kendrick Mcelravy'];
        return view('pathology-a.index')->with('model',$model);
    }

    public function html2canvas(Request $request){
        $base64Image = json_decode($request->getContent());
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image[0]));
        
        $imageName = 'image_' . time() . '.png'; // กำหนดชื่อไฟล์รูปภาพ
        
        $imagePath = 'images/uploads/' . $imageName;
        File::put(public_path($imagePath), $imageData);

        // บันทึกข้อมูลรูปภาพในฐานข้อมูล
        $image = new PathologyReports();
        $image->image_data = $imageData;
        $image->image_name = $imageName;
        $image->save();


    }

    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use \App\Models\PathologyReports;

class PathologyController extends Controller
{
    //
    public function index(){        
        $model = ['hn'=>'000088973', 'fname'=>'Laravel', 'lname'=>'version 10','age'=>'30','gender'=>'F','cdate'=>'23 ก.ค. 2566' ,'srdate'=>'23 ก.ค. 2566' ,'rdate'=>'23 ก.ค. 2566','doctor'=>'Dr. Kendrick Mcelravy'];
        return view('pathology-a.index')->with('model',$model);
    }

    public function store(Request $request){
        $images = json_decode($request->input('report'));
        $item = json_decode($request->input('items'));
        return response()->json(count($item->phatology_diag));
        $model = new PathologyReports();

        switch (count($images)) {
            case 1 :
                $model->image1 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[0]));
            break;
            case 2 :
                $model->image1 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[0]));
                $model->image1 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[1]));
            break;
            case 3 :
                $model->image1 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[0]));
                $model->image2 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[1]));
                $model->image3 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[2]));
            break;
            case 4 :
                $model->image1 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[0]));
                $model->image2 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[1]));
                $model->image3 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[2]));
                $model->image4 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[3]));
            break;            
            case 5:
                $model->image1 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[0]));
                $model->image2 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[1]));
                $model->image3 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[2]));
                $model->image4 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[3]));
                $model->image5 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[4]));
            default:
                return;
        }        
        
        //$imageName = 'image_' . time() . '.png'; // กำหนดชื่อไฟล์รูปภาพ        
        //$imagePath = 'images/uploads/' . $imageName;
        //File::put(public_path($imagePath), $imageData);

        // บันทึกข้อมูลรูปภาพในฐานข้อมูล
        $model->id = $item->lab_id;
        $model->lab_order_number = $item->lab_order_number;
        $model->hn = $item->hn;
        $model->name = $item->name;
        $model->lastname = $item->lastname;
        $model->age = $item->age;
        $model->gender = $item->gender;
        $model->collected_at = $item->collected_at;
        $model->received_at = $item->received_at;
        $model->physician = $item->hn;
        $model->clinical_history = $item->hn;
        $model->clinical_diagnosis = $item->hn;
        $model->phatology_diag = $item->hn;
        $model->gross_examination = $item->hn;
        $model->gross_examiner = $item->hn;
        $model->save();

        // return response()->json($key);

    }

    
}

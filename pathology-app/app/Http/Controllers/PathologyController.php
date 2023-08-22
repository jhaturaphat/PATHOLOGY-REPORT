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
        // return response()->json($item->phatology_diag);
        // return @json_decode(json_encode($item->phatology_diag), true);
        
        
        $model = new PathologyReports();

        $image1 = "";
        $image2 = "";
        $image3 = "";
        $image4 = "";
        $image5 = "";

        switch (count($images)) {
            case 1 :
                $image1 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[0]));
            break;
            case 2 :
                $image1 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[0]));
                $image1 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[1]));
            break;
            case 3 :
                $image1 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[0]));
                $image2 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[1]));
                $image3 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[2]));
            break;
            case 4 :
                $image1 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[0]));
                $image2 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[1]));
                $image3 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[2]));
                $image4 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[3]));
            break;            
            case 5:
                $image1 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[0]));
                $image2 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[1]));
                $image3 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[2]));
                $image4 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[3]));
                $image5 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $images[4]));
            default:
                return response("รูปภาพไม่เข้าเงื่อนไข", 200)->header('Content-Type', 'text/plain');
        }     
        
        
        //$imageName = 'image_' . time() . '.png'; // กำหนดชื่อไฟล์รูปภาพ        
        //$imagePath = 'images/uploads/' . $imageName;
        //File::put(public_path($imagePath), $imageData);
        
        // บันทึกข้อมูลรูปภาพในฐานข้อมูล
       $model->id = $item->id;
        $model->lab_order_number = $item->lab_order_number;
        $model->hn = $item->hn;
        $model->fname = $item->fname;
        $model->lname = $item->lname;
        $model->age = $item->age;
        $model->gender = $item->gender;
        $model->speci_collected_at = $item->speci_collected_at;
        $model->speci_received_at = $item->speci_received_at;
        $model->date_of_report = $item->date_of_report;
        $model->physician = $item->physician;
        $model->clinical_history = $item->clinical_history;
        $model->clinical_diagnosis = $item->clinical_diagnosis;
        //$model->phatology_diag = ['1'=>'AAAA', '2'=>'BBBBB']; //เก็บเป็น Object json JSON_FORCE_OBJECT
        $model->gross_examination = $item->gross_examination;
        $model->gross_examiner = $item->gross_examiner;
        $model->gross_date = $item->gross_date;
        $model->microscopic_description = $item->microscopic_description;
        $model->pathologist = $item->pathologist;
        $model->image1 = $image1;
        $model->image2 = $image2;
        $model->image3 = $image3;
        $model->image4 = $image4;
        $model->image5 = $image5;
        $model->save();

        return;

        $item_phatology_diag = [];
        foreach((array)$item->phatology_diag as $key => $value){           
            $item_phatology_diag[$key] = $value;
        }        

        $json = [
            "key" => "value",
            "another_key" => "another_value"
        ];
        $data = json_encode($json, true);
        // return json_decode( json_encode($item->phatology_diag), true);
        $model = [
            'id'                    => $item->id,
            'lab_order_number'      => $item->lab_order_number,
            'hn'                    => $item->hn,
            'fname'                 => $item->fname,
            'lname'                 => $item->lname,
            'age'                   => $item->age,
            'gender'                => $item->gender,
            'speci_collected_at'    => $item->speci_collected_at,
            'speci_received_at'     => $item->speci_received_at,
            'date_of_report'        => $item->date_of_report,
            'physician'             => $item->physician,
            'clinical_history'      => $item->clinical_history,
            'clinical_diagnosis'    => $item->clinical_diagnosis,
            // 'phatology_diag'        => $data,
            'gross_examination'     => $item->gross_examination,
            'gross_examiner'        => $item->gross_examiner,
            'gross_date'            => $item->gross_date,
            'microscopic_description'=>$item->microscopic_description,
            'pathologist'           => $item->pathologist,
            'image1'                => $image1,
            'image2'                => $image2,
            'image3'                => $image3,
            'image4'                => $image4,
            'image5'                => $image5
        ];

        // https://www.youtube.com/watch?v=Mzl8i-gs6ZQ   ตัวอย่าง
        $post = PathologyReports::create($model);


        // return response()->json($key);
    }

    
}

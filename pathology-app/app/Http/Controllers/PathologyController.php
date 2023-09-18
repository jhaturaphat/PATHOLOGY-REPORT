<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use \App\Models\PathologyReports;
use Illuminate\Support\Facades\DB;
use App\Models\Image;
use PhpParser\Node\Stmt\TryCatch;

class PathologyController extends Controller
{
    //
    public function index(){             
        $model = PathologyReports::orderBy('id', 'DESC')->paginate(15);
        // print_r($model);
        return view('pathology-a.index')->with('model',$model);
    }
    public function findId(Request $request){
        
        try {           
            $model = PathologyReports::find($request->id);
            if($model){ 
                PathologyReports::where('id', $request->id)->update(['release' => 'W']);
                $request->session()->put("id",$model->id); 
                return $model->toJson();
            }
            return Response()->json(['message'=>['errorInfo'=>'ไม่พบข้อมูล ID ที่ส่งมา']], 501);
        } catch (QueryException $ex) {            
            return Response()->json(['message'=>$ex], 501);
        }
        
    }

    public function edit(string $id){

        return view('pathology-a.report')->with('id',$id);
    }

    public function report(){
        return view('pathology-a.report');
    }


    public function store(Request $request){
        try {           
        
        $jsonDataObject = $request->json()->all();
        
        $item = (object)$jsonDataObject['item'];
        $images = $jsonDataObject['image'];
        $model = new PathologyReports();

        // return Response()->json(['message'=>count($images)]);
        $image1 = null;
        $image2 = null;
        $image3 = null;
        $image4 = null;
        $image5 = null;

        switch (count($images)) {
            case 1 :
                $image1 = $this->B64toImage($images[0]); //data:image\/png;base64,                
                break;
            case 2 :
                $image1 = $this->B64toImage($images[0]); 
                $image2 = $this->B64toImage($images[1]); 
                break;
            case 3 :
                $image1 = $this->B64toImage($images[0]); 
                $image2 = $this->B64toImage($images[1]);
                $image3 = $this->B64toImage($images[2]);
                break;
            case 4 :
                $image1 = $this->B64toImage($images[0]); 
                $image2 = $this->B64toImage($images[1]);
                $image3 = $this->B64toImage($images[2]);
                $image4 = $this->B64toImage($images[3]);
                break;            
            case 5:
                $image1 = $this->B64toImage($images[0]);
                $image2 = $this->B64toImage($images[1]);
                $image3 = $this->B64toImage($images[2]);
                $image4 = $this->B64toImage($images[3]);
                $image5 = $this->B64toImage($images[4]);
                break;  
            default:
                return Response()->json(['message'=>'จำนวนรูปภาพไม่เข้าเงื่อนไข หรือ ไม่ได้ส่งรูปภาพมาบันทึก'], 201);
        }  
        
        // return Response()->json(['message'=>"TEST"]);
        
        $model->outid = $item->outid;
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
        $model->phatology_diag_1 = $item->phatology_diag_1; 
        $model->phatology_diag_2 = $item->phatology_diag_2; 
        $model->phatology_diag_3 = $item->phatology_diag_3; 
        $model->phatology_diag_4 = $item->phatology_diag_4; 
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
         if($model->save()){
            return Response()->json(['message'=>'success'], 200);
         }
        } catch (QueryException $ex) {            
            return Response()->json(['message'=>$ex], 501);
        }
        
        
    }


    public function Update(Request $request){
        try {           
        
            $jsonDataObject = $request->json()->all();
            
            $item = (object)$jsonDataObject['item'];
            $images = $jsonDataObject['image'];
            $model = null;
            if($request->session()->has("id")){
                $id = $request->session()->get("id"); 
                $request->session()->forget('id');
                $model = PathologyReports::find($id);  
            }else{
                return Response()->json(['message'=>['errorInfo'=>'ไม่พบข้อมูล Session $id กลับไปหน้าเริ่มต้น']], 501);
            }
    
            $image1 = null;
            $image2 = null;
            $image3 = null;
            $image4 = null;
            $image5 = null;
    
            switch (count($images)) {
                case 1 :
                    $image1 = $this->B64toImage($images[0]); //data:image\/png;base64,                
                    break;
                case 2 :
                    $image1 = $this->B64toImage($images[0]); 
                    $image2 = $this->B64toImage($images[1]); 
                    break;
                case 3 :
                    $image1 = $this->B64toImage($images[0]); 
                    $image2 = $this->B64toImage($images[1]);
                    $image3 = $this->B64toImage($images[2]);
                    break;
                case 4 :
                    $image1 = $this->B64toImage($images[0]); 
                    $image2 = $this->B64toImage($images[1]);
                    $image3 = $this->B64toImage($images[2]);
                    $image4 = $this->B64toImage($images[3]);
                    break;            
                case 5:
                    $image1 = $this->B64toImage($images[0]);
                    $image2 = $this->B64toImage($images[1]);
                    $image3 = $this->B64toImage($images[2]);
                    $image4 = $this->B64toImage($images[3]);
                    $image5 = $this->B64toImage($images[4]);
                    break;  
                default:
                    return Response()->json(['message'=>'จำนวนรูปภาพไม่เข้าเงื่อนไข หรือ ไม่ได้ส่งรูปภาพมาบันทึก'], 201);
            }  
           
            $model->outid = $item->outid;
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
            $model->phatology_diag_1 = $item->phatology_diag_1; 
            $model->phatology_diag_2 = $item->phatology_diag_2; 
            $model->phatology_diag_3 = $item->phatology_diag_3; 
            $model->phatology_diag_4 = $item->phatology_diag_4; 
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
            $model->release = 'N';
             if($model->save()){
                return Response()->json(['message'=>'success'], 200);
             }
            } catch (QueryException $ex) {            
                return Response()->json(['message'=>$ex], 501);
            }
    }



    protected function B64toImage($data = ""){             
        $imageBinary = base64_decode(str_replace('data:image/png;base64,', '', mb_convert_encoding($data, 'UTF-8', 'UTF-8')), false);
        // $fileName = uniqid() . '.png';
        // Storage::disk('local')->put('images/'.$fileName, $imageBinary);      
        return $imageBinary;
    }

    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use App\Models\PathologyReports;
use App\models\LabOrderImage;


class PathologyController extends Controller
{
    //
    public function index(){          
        try {
            $model = PathologyReports::where("user_id","=", Auth::user()->id)->orderBy('id', 'DESC')->paginate(15);        
            return view('pathology-a.index')->with('model',$model);
        } catch (QueryException $ex) {
            return Response()->json(['message'=>$ex], 501);
        }
    }
    public function findId(Request $request){
        //P=ยืนยันผลแล้ว, A=ยืนยันผลอัตโนมัติ, W=ยืนยันผลเอง
        try {           
            $model = PathologyReports::where("id", "=", $request->id)->where('release','!=' , "P")->first();
            if($model){ 
                PathologyReports::where('id', $request->id)->update(['release' => 'A']);
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

    public function destroy(string $id){
        //P=ยืนยันผลแล้ว, A=ยืนยันผลอัตโนมัติ, W=ยืนยันผลเอง
        try {
            $model = PathologyReports::where("id", "=", $id)->where('release','!=' , "P")->where("user_id" ,"=", Auth::user()->id)->delete();
            if($model){
                session()->flash('success', 'ลบข้อมูลสำเร็จ');
                return $this->index();
            }else{
                session()->flash('danger', 'ไม่พบข้อมูลที่ต้องการลบ');
                return $this->index();
            }
        } catch (QueryException $ex) {
            return Response()->json(['message'=>$ex], 501);
        }
    }

    public function release(string $id){
        //P=ยืนยันผลแล้ว, A=ยืนยันผลอัตโนมัติ, W=ยืนยันผลเอง
        try {
            $model = PathologyReports::where("id", "=", $id)->where('release','!=' , "P")->first();
            if($model){
                LabOrderImage::create([
                    'lab_order_number' => $model->lab_order_number,
                    'image1' => $model->image1,
                    'image2' => $model->image2,
                    'image3' => $model->image3,
                    'image4' => $model->image4,
                    'image5' => $model->image5,
                ]);
                $model->update(["release" => "P"]);
                session()->flash('success', 'บันทึกสำเร็จ');
            }
            return $this->index();
        } catch (QueryException $ex) {
            return Response()->json(['message'=>$ex], 501);
        }
    }

    // บันทึกรายงาน
    public function store(Request $request){        
        try {           
        
        $jsonDataObject = $request->json()->all();
        
        $item = (object)$jsonDataObject['item'];
        $images = $jsonDataObject['image'];
        $model = new PathologyReports();

        // รับวันที่และเวลาปัจจุบัน
        $currentDateTime = new \DateTime();
        // สร้าง DateInterval ที่มีการบวกเพิ่ม 2 วัน
        $interval = new \DateInterval('P2D');
        // บวกเพิ่มวันที่และเวลา
        $currentDateTime->add($interval);
        // แสดงผลลัพธ์
        $set_release_date = $currentDateTime->format('Y-m-d H:i:s');

        // return Response()->json(['message'=>(!empty($item->txt_image1)) ? $item->txt_image1 : ""]);

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
        
        $model->txt_image_1 = (!empty($item->txt_image1)) ? $item->txt_image1 : "" ;
        $model->txt_image_2 = (!empty($item->txt_image2)) ? $item->txt_image2 : "" ;
        $model->txt_image_3 = (!empty($item->txt_image3)) ? $item->txt_image3 : "" ;
        $model->txt_image_4 = (!empty($item->txt_image4)) ? $item->txt_image4 : "" ;
        $model->txt_image_5 = (!empty($item->txt_image5)) ? $item->txt_image5 : "" ;
        
        $model->pathologist = $item->pathologist;
        $model->image1 = $image1;
        $model->image2 = $image2;
        $model->image3 = $image3;
        $model->image4 = $image4;
        $model->image5 = $image5;
        $model->set_release_date = $set_release_date;
        $model->user_id = Auth::user()->id;
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

            // รับวันที่และเวลาปัจจุบัน
        $currentDateTime = new \DateTime();
        // สร้าง DateInterval ที่มีการบวกเพิ่ม 2 วัน
        $interval = new \DateInterval('P1D');
        // บวกเพิ่มวันที่และเวลา
        $currentDateTime->add($interval);
        // แสดงผลลัพธ์
        $set_release_date = $currentDateTime->format('Y-m-d H:i:s');
    
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
            
            $model->txt_image_1 = (!empty($item->txt_image1)) ? $item->txt_image1 : "" ;
            $model->txt_image_2 = (!empty($item->txt_image2)) ? $item->txt_image2 : "" ;
            $model->txt_image_3 = (!empty($item->txt_image3)) ? $item->txt_image3 : "" ;
            $model->txt_image_4 = (!empty($item->txt_image4)) ? $item->txt_image4 : "" ;
            $model->txt_image_5 = (!empty($item->txt_image5)) ? $item->txt_image5 : "" ;
        
            $model->pathologist = $item->pathologist;
            $model->image1 = $image1;
            $model->image2 = $image2;
            $model->image3 = $image3;
            $model->image4 = $image4;
            $model->image5 = $image5;
            $model->set_release_date = $set_release_date;
            // $model->release = 'N';
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

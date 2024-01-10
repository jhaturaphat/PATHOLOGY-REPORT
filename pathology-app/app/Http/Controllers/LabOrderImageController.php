<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\LabOrderImage;
use App\Models\Surgical;


class LabOrderImageController extends Controller
{
    //
    
    public function index(){
        $model = LabOrderImage::limit(1)->get();
        return view('his.laborderimage.index')->with('model', $model);
    }

    public function syncToImageHis(){
        $model = Surgical::where('release', 'A')->limit(1000)->get();      
        // dd($model); 
        $model = $model->makeVisible(['image1','image2','image3','image4','image5']);        
        try {  
            foreach($model as $item){  
                $data = LabOrderImage::where('lab_order_number', $item->lab_order_number)->first();
                $iq = 0;
                if($data){
                    if ($data->image1) {
                        $iq++;                        
                    }
                    if ($data->image2) {
                        $iq++; 
                    }
                    if ($data->image3) {
                        $iq++; 
                    }
                    if ($data->image4) {
                        $iq++; 
                    }
                    if ($data->image5) {
                        $iq++; 
                    }

                    switch($iq){
                        case 1:
                            $data->image2 = $item->image1;
                            $data->image3 = $item->image2;
                            $data->image4 = $item->image3;
                            $data->image5 = $item->image4;
                        break;
                        case 2:
                            $data->image3 = $item->image1;
                            $data->image4 = $item->image2;
                            $data->image5 = $item->image3;
                        break;
                        case 3:
                            $data->image4 = $item->image1;
                            $data->image5 = $item->image2;
                        break;
                        case 4:
                            $data->image5 = $item->image1;
                        break;
                        default:
                            return Response()->json(['message'=>'พื้นที่ image 1-5 ไม่ว่างสำหรับข้อมูลใหม่'], 206);
                    }

                    // บันทึกการเปลี่ยนแปลง
                    $data->save();
                }else{
                    LabOrderImage::create([
                        'lab_order_number' => $item->lab_order_number,
                        'image1' => $item->image1,
                        'image2' => $item->image2,
                        'image3' => $item->image3,
                        'image4' => $item->image4,
                        'image5' => $item->image5,
                    ]);
                }
                Surgical::find($item->id)->update(["release" => "P"]);
            }
        } catch (QueryException $ex) { //Throwable   //QueryException                
            return Response()->json(['message'=>$ex], 501);
        } 
    }

    protected function labOrderImageCheck($lab_order_number){

    }
 
    

    public function findLabOrder(Request $request){
        $hn = $request->term;

        if(strlen($hn) < 9){
            $hn = str_pad($request->term,9,"0",STR_PAD_LEFT);  //ใส่่ 000000000 หน้า HN ให้ครบ 9 หลัก
        }

        
        $sql = <<<____SQL
        SELECT 
        lh.lab_order_number
        ,lh.vn, lh.hn
        , pt.fname, pt.lname, IF(pt.sex = '1', 'MALE','FEMALE') as gender, IF(opi.operation_date IS NULL, CONCAT(TIMESTAMPDIFF(YEAR, pt.birthday, CURDATE())), opi.age_text) AS age
        ,opi.operation_date
        ,lh.order_date, lh.order_time, lh.report_date, lh.report_time
        ,lh.confirm_report, lh.department, lh.form_name, lh.receive_date, lh.receive_time
        ,lh.lab_receive_number, lh.lis_order_no, lh.order_department, lab_perform_status_id, lh.notify_depcode
        ,lo.lab_items_code, lo.lab_order_result, lo.confirm, lo.lab_items_name_ref, lo.lab_items_normal_value_ref, li.items_is_outlab
        ,lo.lab_items_sub_group_code, lo.order_type
        ,li.lab_items_name, li.lab_items_unit, li.lab_items_normal_value, li.possible_value, li.lab_items_sub_group_code
        ,li.specimen_code, li.display_order, li.ecode, li.sub_group_list
        ,IF(opi.request_doctor != '' OR opi.request_doctor != NULL, (SELECT `name` FROM doctor WHERE `code` = opi.request_doctor), dt.`name`) as doctor_name
        FROM lab_head as lh
        INNER JOIN lab_order as lo ON lh.lab_order_number = lo.lab_order_number
        INNER JOIN lab_items as li ON lo.lab_items_code = li.lab_items_code
        INNER JOIN patient as pt ON lh.hn = pt.hn
        INNER JOIN doctor as dt ON lh.doctor_code = dt.`code`
        LEFT JOIN (
            SELECT *, an as vnu
            FROM operation_list
            WHERE hn = ? AND an <> ''
            UNION
            SELECT *, vn as vnu
            FROM operation_list
            WHERE hn = ? AND vn <> ''
        ) as opi ON lh.vn = opi.vnu
        WHERE lh.hn = ? AND li.lab_items_group = 7 /*AND lh.confirm_report = 'N'*/ AND lh.form_name IN('CYTOLOGY', 'Pathology')
        ORDER BY lh.order_date DESC
        LIMIT 100
        ____SQL;
        
        DB::connection('mysql_his')->select("SET NAMES utf8");
        $results = DB::connection('mysql_his')->select($sql,[$hn, $hn, $hn]);        
        
        return response()->json($results);
    }

    function countImage(Request $request){
        $data = LabOrderImage::where('lab_order_number', $request->lab_order_number)->first();
        // dd($data);
        $count = 0;  
        $images = [];      
        if($data){
            if ($data->image1) {   
                $images['image1'] = base64_encode($data->image1);              
                $count++;                        
            }
            if ($data->image2) {
                $images['image2'] = base64_encode($data->image2);  
                $count++; 
            }
            if ($data->image3) {
                $images['image3'] = base64_encode($data->image3);  
                $count++; 
            }
            if ($data->image4) {
                $images['image4'] = base64_encode($data->image4);  
                $count++; 
            }
            if ($data->image5) {
                $images['image5'] = base64_encode($data->image5);  
                $count++; 
            }
        }
        return response()->json(['count'=>$count, 'images'=>$images]);
    }
}

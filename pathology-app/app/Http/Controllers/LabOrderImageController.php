<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\models\LabOrderImage;
use App\models\User;

class LabOrderImageController extends Controller
{
    //
    
    public function index(){
        $model = LabOrderImage::limit(1)->get();
        return view('his.laborderimage.index')->with('model', $model);
    }

    public function template1(){
        return view('his.laborderimage.template1');
    }

    public function findLabOrder(Request $request){
        $term = $request->term;

        if(strlen($request->term) < 9){
            $term = str_pad($request->term,9,"0",STR_PAD_LEFT);  //ใส่่ 000000000 หน้า HN ให้ครบ 9 หลัก
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
        ,dt.`name` as doctor_name
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
        WHERE lh.hn = ? AND li.lab_items_group = 7 AND lh.confirm_report = 'N'
        ORDER BY lh.order_date DESC
        LIMIT 100
        ____SQL;
        
        DB::connection('mysql_his')->select("SET NAMES utf8");
        $results = DB::connection('mysql_his')->select($sql,[$term, $term, $term]);
        return response()->json($results);
    }
}

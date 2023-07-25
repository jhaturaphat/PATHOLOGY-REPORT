<?php

namespace App\Http\Controllers;

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

    public function findLabOrder(){
        return response()->json([
            [
                'hn'=>'000088973', 
                'fname'=>'Laravel', 
                'lname'=>'version 10',
                'age'=>'30',
                'gender'=>'F',
                'cdate'=>'23 ก.ค. 2566' ,
                'srdate'=>'23 ก.ค. 2566' ,
                'rdate'=>'23 ก.ค. 2566',
                'doctor'=>'Dr. Kendrick Mcelravy'
            ],
            [
                'hn'=>'000088973', 
                'fname'=>'jquery', 
                'lname'=>'Jquery-ui 10',
                'age'=>'20',
                'gender'=>'M',
                'cdate'=>'23 ก.ค. 2566' ,
                'srdate'=>'23 ก.ค. 2566' ,
                'rdate'=>'23 ก.ค. 2566',
                'doctor'=>'Dr. Kendrick Laravel'
            ]
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PathologyController extends Controller
{
    //
    public function index(){        
        $model = ['hn'=>'000088973', 'fname'=>'Laravel', 'lname'=>'version 10','age'=>'30','gender'=>'F','cdate'=>'23 ก.ค. 2566' ,'srdate'=>'23 ก.ค. 2566' ,'rdate'=>'23 ก.ค. 2566','doctor'=>'Dr. Kendrick Mcelravy'];
        return view('pathology-a.index')->with('model',$model);
    }

    public function html2canvas(Request $request){
        dd(json_decode($request));
    }

    
}

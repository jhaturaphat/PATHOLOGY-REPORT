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
}

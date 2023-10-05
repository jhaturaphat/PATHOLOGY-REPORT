<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    function drag(){
        return view('test.drag');
    }

    function accept(){
        return view("test.accept");
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\models\User;

class UserController extends Controller
{
    public function loginForm(){
        return view('user.login');
    }

    public function login(Request $request){        
        $credentials = $request->only('loginname', 'passweb');
        $credentials = \App\Models\User::where([
            'loginname' => $request->loginname,
            'passweb' => md5($request->passweb)
        ])->first()->toArray();
        // return print_r($user->toArray());
        if (Auth::attempt($credentials)) {
            // สำเร็จ: เข้าสู่ระบบแล้ว            
            return redirect('/pathology-a/index');
        }
        
        // ไม่สำเร็จ: รีเดิมไปยังหน้าเข้าสู่ระบบพร้อมกับข้อความแจ้งเตือน
        return back()->withErrors(['email' => 'ข้อมูลเข้าสู่ระบบไม่ถูกต้อง'])->withInput();
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}

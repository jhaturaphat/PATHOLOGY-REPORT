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

    public function loginX(Request $request){        
        $loginname = $request->input('loginname');
        $passweb = $request->input('passweb');    
        // ดึงข้อมูลผู้ใช้จากฐานข้อมูลของคุณ โดยใช้ชื่อผู้ใช้หรืออื่น ๆ
        $user = User::where('loginname', $loginname)->first();    
        if ($user && md5($passweb) === $user->passweb) {
            // รหัสผ่านถูกต้อง
            if(Auth::guard('hosxp_opduser')->login($user)){
                return redirect()->intended('/pathology-a/index');
            }
        }    
        // ไม่สำเร็จ: รีเดิมไปยังหน้าเข้าสู่ระบบพร้อมกับข้อความแจ้งเตือน
        return back()->withErrors(['email' => 'ข้อมูลเข้าสู่ระบบไม่ถูกต้อง'])->withInput();
    }

    public function login(Request $request){        
        $credentials = $request->only('loginname', 'passweb');
        $credentials['passweb'] = md5($credentials['passweb']); // เข้ารหัสรหัสผ่านด้วย MD5
        
        if (Auth::guard('hosxp_opduser')->attempt(['loginname'=>$credentials['loginname'], 'passweb'=>$credentials['passweb']])) {
            // รหัสผ่านถูกต้อง
            return redirect()->intended('/pathology-a/index');
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

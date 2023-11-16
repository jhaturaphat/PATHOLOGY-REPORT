<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\models\Opduser;
use Illuminate\Support\Facades\Session;


class OpduserController extends Controller
{

    public function loginForm(){
        return view('user.login');
    }
    
    public function login(Request $request){        
        $credentials = $request->only('email', 'passweb');
        $credentials['password'] = md5($credentials['password']); // เข้ารหัสรหัสผ่านด้วย MD5
        dd(Auth::guard('hosxp_opduser')->attempt($credentials));
        if (Auth::guard('hosxp_opduser')->attempt(['loginname' => $request->loginname, 'passweb' => md5($request->passweb)])) {            
            return redirect()->intended('/surgical/index');
        }        
        return back()->withErrors(['email' => 'ข้อมูลเข้าสู่ระบบไม่ถูกต้อง'])->withInput();
    }

    public function loginX(Request $request){        
        $loginname = $request->input('loginname');
        $passweb = $request->input('passweb');    
        // ดึงข้อมูลผู้ใช้จากฐานข้อมูลของคุณ โดยใช้ชื่อผู้ใช้หรืออื่น ๆ
        $user = Opduser::where('loginname', $loginname)->first();    
        if ($user && md5($passweb) === $user->passweb) {            
            Auth::guard('hosxp_opduser')->login($user);
            return redirect()->intended('/surgical/index');
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

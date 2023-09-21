<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;

class UserController extends Controller
{
    public function loginForm(){
        return view('user.login');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // สำเร็จ: เข้าสู่ระบบแล้ว
            return redirect()->intended('/dashboard');
        }
    
        // ไม่สำเร็จ: รีเดิมไปยังหน้าเข้าสู่ระบบพร้อมกับข้อความแจ้งเตือน
        return back()->withErrors(['email' => 'ข้อมูลเข้าสู่ระบบไม่ถูกต้อง'])->withInput();
    }

    public function registerForm(){        
        return view('user.register');
    }

    public function register(){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        Auth::login($this->create($request->all()));
    
        return redirect('/dashboard');
    }

        
    protected function create(array $data){
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}

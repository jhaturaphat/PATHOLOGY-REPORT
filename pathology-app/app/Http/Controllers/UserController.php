<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\models\User;

class UserController extends Controller
{
    // ฟังก์ชันเรียกหน้า ฟอร์ม LOGIN
    public function loginForm(){
        if(!Auth::check()) return view('user.login');
        return back();
    }
    // ฟังก์ชัน LOGIN
    public function login(Request $request){      
        if(Auth::check()) return back(); 
        $credentials = $request->only('email', 'password');         
        if (Auth::guard('web')->attempt($credentials)) {            
            return redirect()->intended('/surgical/index');
        }        
        return back()->withErrors(['email' => 'ข้อมูลเข้าสู่ระบบไม่ถูกต้อง'])->withInput();
    }

    // ฟังก์ชัน ออกจากระบบ
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // ฟังก์ชันเรียกนห้า ฟอร์มลงทะเบียน
    public function registerForm(){        
        //if (Auth::check() && Auth::user()->is_admin){
            return view('user.register');            
        //}
        return redirect('/');
        
    }

    // ฟังก์ชันสำหรับการลงทะเบียน
    public function register(Request $request){        
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]); 
            Auth::login($this->create($request->all()));
            return redirect('/surgical/index');
        } catch (\Throwable $th) {
            session()->flash('danger', "Email นี้มีผู้ใช้งานแล้ว");
            return back();
        }         
    }

    protected function create(array $data)
    {    
        try {
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],  
            ]);
            
        } catch (QueryException $ex) {            
            return Response()->json(['message'=>$ex], 501);
        }   
        
    }

    public function chPassword(Request $request){
        try {
            $request->validate([
                'password' => $request['password'],
                'new_password' => $request['new_password'],
                'contirm_passowrd' => $request['contirm_passowrd'],  
            ]);
            
        } catch (QueryException $ex) {            
            return Response()->json(['message'=>$ex], 501);
        }   
    }

    protected function findEmail(string $email){
        return User::where("email",$email)->get();
    }

}

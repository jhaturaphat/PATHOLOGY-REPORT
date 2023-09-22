<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd($request);
        // dd($request->getRequestUri());
        // ตรวจสอบว่า Session ยังคงใช้งานได้หรือไม่
        if (!Session::has('login')) {
            // Session หมดอายุหรือไม่ถูกต้อง
            return redirect('/login');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->status == 1 ){
            return $next($request);
        }
        return redirect()->route('login')->with('active_message', 'Tài khoản của bạn đã bị khóa, liên hệ với quản trị viên để biết thêm thông tin');
    }
}

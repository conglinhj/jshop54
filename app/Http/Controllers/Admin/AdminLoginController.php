<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class AdminLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    use AuthenticatesUsers {
        logout as adminRedirectLogout;
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    protected $redirectTo = '/';

    protected function redirectTo()
    {
        return route('backend');
    }

    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    public function logout(Request $request)
    {
        $this->adminRedirectLogout($request);

        return redirect('/backend');
    }

}

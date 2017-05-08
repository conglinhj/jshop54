<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function dashBoard()
    {
        return view('backend.extends.dashboard');
    }
}

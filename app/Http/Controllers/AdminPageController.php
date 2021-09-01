<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function home()
    {
        return view('admin.singer-manager.list');
    }
}

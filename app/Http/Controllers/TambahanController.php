<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TambahanController extends Controller
{
    public function index()
    {
        return view('tambahan.index');
    }
}

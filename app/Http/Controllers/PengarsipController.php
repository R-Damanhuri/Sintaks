<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengarsipController extends Controller
{
    public function index()
    {
        return view('pengarsiphome');
    }
}

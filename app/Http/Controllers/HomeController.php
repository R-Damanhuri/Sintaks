<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jml_users = DB::table('users')->where('role_id',2)->count();
        $jml_sm = DB::table('surat_masuks')->count();
        $jml_sk = DB::table('surat_keluars')->count();

        return view('home', compact('jml_users', 'jml_sm', 'jml_sk'));
    }
}
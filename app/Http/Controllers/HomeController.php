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
        $jml_users = DB::table('users')
            ->where('role_id', 2)
            ->count();
        $jml_sm = DB::table('surat_masuks')->count();
        $jml_sk = DB::table('surat_keluars')->count();

        // Mengambil tanggal awal dan akhir bulan ini
        $startDate = date('Y-m-01');
        $endDate = date('Y-m-t');

        #Surat masuk bulan ini
        $sm_bln = DB::table('surat_masuks')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        #Surat keluar bulan ini
        $sk_bln = DB::table('surat_keluars')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        // Mengambil tahun saat ini
        $currentYear = now()->year;

        #Surat masuk setiap bulan tahun ini
        $sm_th = DB::table('surat_masuks')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count')
            ->toArray();

        #Surat keluar setiap bulan tahun ini
        $sk_th = DB::table('surat_keluars')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count')
            ->toArray();

        #Surat masuk jenis count
        $sm_jns_count = DB::table('surat_masuks')
            ->select(DB::raw('jenis_surat_id'), DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', '=', $currentYear)
            ->groupBy('jenis_surat_id')
            ->orderBy('jenis_surat_id')
            ->pluck('count')
            ->toArray();

        #Surat keluar jenis count
        $sk_jns_count = DB::table('surat_keluars')
            ->select(DB::raw('jenis_surat_id'), DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', '=', $currentYear)
            ->groupBy('jenis_surat_id')
            ->orderBy('jenis_surat_id')
            ->pluck('count')
            ->toArray();

        #Surat masuk jenis name
        $sm_jns_name = DB::table('jenis_surats')
            ->select(DB::raw('id'), DB::raw('nama_jenis'))
            ->orderBy('id')
            ->pluck('nama_jenis')
            ->toArray();

        return view('home', compact('jml_users', 'jml_sm', 'jml_sk', 'sm_bln', 'sk_bln', 'sm_th', 'sk_th', 'sm_jns_count', 'sk_jns_count', 'sm_jns_name'));
    }
}

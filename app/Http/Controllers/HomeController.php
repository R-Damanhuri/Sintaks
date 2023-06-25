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

        #Jenis surat masuk count
        $sm_jns_count = DB::table('surat_masuks')
            ->leftJoin('jenis_surats', 'surat_masuks.jenis_surat_id', '=', 'jenis_surats.id')
            ->select('surat_masuks.jenis_surat_id', DB::raw('COUNT(*) as count'))
            ->whereYear('surat_masuks.created_at', $currentYear)
            ->groupBy('surat_masuks.jenis_surat_id')
            ->orderBy('surat_masuks.jenis_surat_id')
            ->pluck('count', 'surat_masuks.jenis_surat_id')
            ->toArray();

        // Mengisi jenis_surat_id yang tidak ada dengan nilai 0
        $jenis_surat_ids = DB::table('jenis_surats')->pluck('id');
        foreach ($jenis_surat_ids as $jenis_surat_id) {
            if (!isset($sm_jns_count[$jenis_surat_id])) {
                $sm_jns_count[$jenis_surat_id] = 0;
            }
        }
        $sm_jns_count = array_values($sm_jns_count);

        #Jenis surat keluar count
        $sk_jns_count = DB::table('surat_keluars')
            ->leftJoin('jenis_surats', 'surat_keluars.jenis_surat_id', '=', 'jenis_surats.id')
            ->select('surat_keluars.jenis_surat_id', DB::raw('COUNT(*) as count'))
            ->whereYear('surat_keluars.created_at', $currentYear)
            ->groupBy('surat_keluars.jenis_surat_id')
            ->orderBy('surat_keluars.jenis_surat_id')
            ->pluck('count', 'surat_keluars.jenis_surat_id')
            ->toArray();

        // Mengisi jenis_surat_id yang tidak ada dengan nilai 0
        $jenis_surat_ids = DB::table('jenis_surats')->pluck('id');
        foreach ($jenis_surat_ids as $jenis_surat_id) {
            if (!isset($sk_jns_count[$jenis_surat_id])) {
                $sk_jns_count[$jenis_surat_id] = 0;
            }
        }
        $sk_jns_count = array_values($sk_jns_count);

        #Jenis surat name
        $jns_name = DB::table('jenis_surats')
            ->select(DB::raw('id'), DB::raw('nama_jenis'))
            ->orderBy('id')
            ->pluck('nama_jenis')
            ->toArray();

        return view('home', compact('jml_users', 'jml_sm', 'jml_sk', 'sm_bln', 'sk_bln', 'sm_th', 'sk_th', 'sm_jns_count', 'sk_jns_count', 'jns_name'));
    }
}

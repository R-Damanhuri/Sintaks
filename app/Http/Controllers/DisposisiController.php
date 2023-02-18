<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disposisi;
use App\Models\SuratMasuk;
use App\Models\Jabatan;
use App\Models\Pengolah;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DisposisiController extends Controller
{
    public function index()
    {
        $surat = SuratMasuk::all();
        $data = Disposisi::all();
        $pengolah = Pengolah::all();
        $jabatan = Jabatan::all();
        return view('disposisi.index', compact('data', 'surat', 'pengolah', 'jabatan'));
        // view(folder.file, ...)
    }

    public function formTambah()
    {
        $surat = SuratMasuk::all();
        $jabatan = Jabatan::all();
        $pengolah = Pengolah::all();

        return view('disposisi.formTambah', compact('surat', 'jabatan', 'pengolah'));
    }

    public function getPengolah($id)
    {
        $pengolah = DB::table('pengolahs')
            ->get()
            ->where('jabatan_id', $id);
        return response()->json($pengolah);
    }

    public function tambah(Request $request)
    {
        $rules = [
            'intruksi' => 'required',
            'kepada' => 'required',
            'surat_masuk_id' => 'required|unique:disposisis,surat_masuk_id',
        ];

        $message = [
            'intruksi.required' => 'Intruksi disposisi harus diisi.',
            'kepada.required' => 'Jabatan harus diisi.',
            'surat_masuk_id.required' => 'Nomor surat masuk harus diisi.',

            'surat_masuk_id.unique' => 'Disposisi untuk surat masuk dengan nomor ini sudah ada.',
        ];

        $validasi = Validator::make($request->all(), $rules, $message);

        if ($validasi->fails()) {
            return back()
                ->with('add_fails', 'Data Gagal Ditambahkan.')
                ->withInput($request->except('key'))
                ->withErrors($validasi);
        } else {
            if (!empty($request->input('kepada'))) {
                $request['kepada'] = join(',', $request->input('kepada'));
                $data = Disposisi::create($request->all());
            } else {
                $checkbox = '';
            }
            return redirect()
                ->route('disposisi')
                ->with('add_success', 'Data Berhasil Ditambahkan.');
        }
    }

    public function hapus($id)
    {
        $data = Disposisi::find($id);
        $data->delete();
        return redirect()
            ->route('disposisi')
            ->with('delete_success', 'Data Berhasil Dihapus.');
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'intruksi' => 'required',
            'kepada' => 'required',
            'surat_masuk_id' => 'required',
        ];

        $message = [
            'intruksi.required' => 'Intruksi disposisi harus diisi.',
            'kepada.required' => 'Bagian kepada harus diisi.',
            'surat_masuk_id.required' => 'ID Surat masuk harus diisi.',
        ];

        $validasi = Validator::make($request->all(), $rules, $message);
        if ($validasi->fails()) {
            return redirect()
                ->route('disposisi')
                ->with('update_fails', 'Data Gagal Diubah.')
                ->withErrors($validasi);
        } else {
            if (!empty($request->input('kepada'))) {
                $request['kepada'] = join(',', $request->input('kepada'));

                $data = Disposisi::find($id);
                $data->update($request->all());
            } else {
                $checkbox = '';
            }

            return redirect()
                ->route('disposisi')
                ->with('update_success', 'Data Berhasil Diubah.');
        }
    }

    public function exportpdf($id)
    {
        $data = Disposisi::find($id);
        $today = Carbon::today();

        $pengolah = Pengolah::all();
        $jabatan = Jabatan::all();

        view()->share([
            'data' => $data,
            'today' => $today,
            'pengolah' => $pengolah,
            'jabatan' => $jabatan,
        ]);
        $pdf = PDF::loadview('disposisi.templatPDF');
        return $pdf->download('disposisi_' . $data->surat_masuk->no_surat . '.pdf');
    }

    public function menuTambah($id)
    {
        $surat = SuratMasuk::find($id);
        return view('disposisi.menuTambah', compact('surat'));
    }
}

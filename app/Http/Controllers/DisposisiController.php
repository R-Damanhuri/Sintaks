<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disposisi;
use App\Models\SuratMasuk;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PDF;

class DisposisiController extends Controller
{
    public function index()
    {
        $surat = SuratMasuk::all();
        $data = Disposisi::all();
        return view('disposisi.index', compact('data', 'surat'));
        // view(folder.file, ...)
    }

    public function formTambah()
    {
        $surat = SuratMasuk::all();
        return view('disposisi.formTambah', compact('surat'));
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
            'kepada.required' => 'Bagian Kepada harus diisi.',
            'surat_masuk_id.required' => 'Nomor surat masuk harus diisi.',

            'surat_masuk_id.unique' => 'Disposisi untuk surat masuk dengan nomor ini sudah ada.'
        ];

        $validasi = Validator::make($request->all(), $rules, $message);

        if ($validasi->fails()) {
            return back()
                ->with('add_fails', 'Data Gagal Ditambahkan.')
                ->withInput($request->except('key'))
                ->withErrors($validasi);
        } else {

            $data = Disposisi::create($request->all());
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
            'kepada.required' => 'Bagian Kepada harus diisi.',
            'surat_masuk_id.required' => 'ID Surat masuk harus diisi.'
        ];

        $validasi = Validator::make($request->all(), $rules, $message);
        if ($validasi->fails()) {
            return redirect()
                ->route('disposisi')
                ->with('update_fails', 'Data Gagal Diubah.')
                ->withErrors($validasi);
        } else {

            $data = Disposisi::find($id);
            $data->update($request->all());

            return redirect()
                ->route('disposisi')
                ->with('update_success', 'Data Berhasil Diubah.');
        }
    }

    public function exportpdf($id)
    {
        $data = Disposisi::find($id);

        view()->share('data', $data);
        $pdf = PDF::loadview('disposisi.templatPDF');
        return $pdf->download('disposisi_'.$data->surat_masuk->no_surat.'.pdf');
    }

    public function menuTambah($id)
    {
        $surat = SuratMasuk::find($id);
        return view('disposisi.menuTambah', compact('surat'));
    }
}

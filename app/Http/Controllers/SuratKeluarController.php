<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKeluar;
use App\Models\JenisSurat;
use File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SuratMasukExport;
use App\Exports\SuratKeluarExport;
use PDF;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $data = SuratKeluar::all();
        $jenis = JenisSurat::all();
        return view('suratkeluar.index', compact('data', 'jenis'));
        // view(folder.file, ...)
    }

    public function formTambah()
    {
        $jenis = JenisSurat::all();
        return view('suratkeluar.formTambah', compact('jenis'));
    }

    public function tambah(Request $request)
    {
        $rules = [
            'no_surat' => 'required|unique:surat_keluars,no_surat',
            'jenis_surat_id' => 'required',
            'perihal' => 'required',
            'penerima' => 'required',
            'tanggal_surat' => 'required|before_or_equal:' . date(DATE_ATOM),
            'file' => 'required|mimes:pdf',
        ];

        $message = [
            'no_surat.required' => 'Nomor surat harus diisi.',
            'jenis_surat_id.required' => 'Jenis surat harus diisi.',
            'perihal.required' => 'Perihal harus diisi.',
            'penerima.required' => 'Penerima harus diisi.',
            'tanggal_surat.required' => 'Tanggal surat harus diisi.',
            'file.required' => 'File harus diisi.',

            'no_surat.unique' => 'Nomor surat sudah ada.',
            'tanggal_surat.before_or_equal' => 'Tanggal surat tidak boleh lebih dari tanggal sekarang.',
            'file.mimes' => 'Format file yang diterima hanya PDF.',
        ];

        $validasi = Validator::make($request->all(), $rules, $message);

        if ($validasi->fails()) {
            return back()
                ->with('add_fails', 'Data Gagal Ditambahkan.')
                ->withInput($request->except('key'))
                ->withErrors($validasi);
        } else {
            
            $data = SuratKeluar::create($request->all());
            if ($request->hasFile('file')) {
                $request->file('file')->move('FileSuratKeluar/', $request->file('file')->getClientOriginalName());
                $data->file = $request->file('file')->getClientOriginalName();
                $data->save();
            }

            return redirect()
                ->route('suratkeluar')
                ->with('add_success', 'Data Berhasil Ditambahkan.');
        }
    }

    public function hapus($id)
    {
        $data = SuratKeluar::find($id);

        if (File::exists(public_path('FileSuratKeluar/' . $data->file))) {
            File::delete(public_path('FileSuratKeluar/' . $data->file));
        }
        $data->delete();
        return redirect()
            ->route('suratkeluar')
            ->with('delete_success', 'Data Berhasil Dihapus.');
    }

    public function update(Request $request, $id)
    {

        $rules = [
            'no_surat' => Rule::unique('surat_keluars')->ignore($request->no_surat),
            'no_surat' => 'required',
            'jenis_surat_id' => 'required',
            'perihal' => 'required',
            'penerima' => 'required',
            'tanggal_surat' => 'required|before_or_equal:' . date(DATE_ATOM),
            'file' => 'mimes:pdf',
        ];

        $message = [
            'no_surat.required' => 'Nomor surat harus diisi.',
            'jenis_surat_id.required' => 'Jenis surat harus diisi.',
            'perihal.required' => 'Perihal harus diisi.',
            'penerima.required' => 'Penerima harus diisi.',
            'tanggal_surat.required' => 'Tanggal surat harus diisi.',

            'no_surat.unique' => 'Nomor surat sudah ada.',
            'tanggal_surat.before_or_equal' => 'Tanggal surat tidak boleh lebih dari tanggal sekarang.',
            'file.mimes' => 'Format file yang diterima hanya PDF.',
        ];
        
        $validasi = Validator::make($request->all(), $rules, $message);

        if ($validasi->fails()) {
            return redirect()
                ->route('suratkeluar')
                ->with('update_fails', 'Data Gagal Diubah.')
                ->withInput($request->except('key'))
                ->withErrors($validasi);
        } else {

            $data = SuratKeluar::find($id);
            $data->update($request->all());
            if ($request->hasFile('file')) {
                File::delete(public_path('FileSuratKeluar/' . $data->file));

                $request->file('file')->move('FileSuratKeluar/', $request->file('file')->getClientOriginalName());
                $data->file = $request->file('file')->getClientOriginalName();
                $data->save();
            }

            return redirect()
                ->route('suratkeluar')
                ->with('update_success', 'Data Berhasil Diubah.');
        }
    }

    public function exportexcel()
    {
        return Excel::download(new SuratKeluarExport, 'laporan-surat-keluar.xlsx', null, $headers = ['no_surat', 'jenis_surat_id', 'perihal','penerima','tanggal_surat']);
    }

    public function exportpdf()
    {
        $data = SuratKeluar::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('suratkeluar.templatPDF');

        return $pdf->download('laporan-surat-keluar.pdf');
    }
}

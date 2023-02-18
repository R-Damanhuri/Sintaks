<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use App\Models\JenisSurat;
use File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SuratMasukExport;
use PDF;


class SuratMasukController extends Controller
{
    public function index()
    {
        $data = SuratMasuk::all();
        $jenis = JenisSurat::all();
        return view('suratmasuk.index', compact('data', 'jenis'));
        // view(folder.file, ...)
    }

    public function formTambah()
    {
        $jenis = JenisSurat::all();
        return view('suratmasuk.formTambah', compact('jenis'));
    }

    public function tambah(Request $request)
    {
        $rules = [
            'no_surat' => 'required|unique:surat_masuks,no_surat',
            'jenis_surat_id' => 'required',
            'perihal' => 'required',
            'pengirim' => 'required',
            'tanggal_surat' => 'required|before_or_equal:' . date(DATE_ATOM),
            'tanggal_terima' => 'required|after_or_equal:tanggal_surat|before_or_equal:' . date(DATE_ATOM),
            'file' => 'required|mimes:pdf',
        ];

        $message = [
            'no_surat.required' => 'Nomor surat harus diisi.',
            'jenis_surat_id.required' => 'Jenis surat harus diisi.',
            'perihal.required' => 'Perihal harus diisi.',
            'pengirim.required' => 'Pengirim harus diisi.',
            'tanggal_surat.required' => 'Tanggal surat harus diisi.',
            'tanggal_terima.required' => 'Tanggal terima harus diisi.',
            'file.required' => 'File harus diisi.',

            'no_surat.unique' => 'Nomor surat sudah ada.',
            'tanggal_surat.before_or_equal' => 'Tanggal surat tidak boleh lebih dari tanggal sekarang.',
            'tanggal_terima.before_or_equal' => 'Tanggal terima tidak boleh lebih dari tanggal sekarang.',
            'tanggal_terima.after_or_equal' => 'Tanggal terima tidak boleh kurang dari tanggal surat.',
            'file.mimes' => 'Format file yang diterima hanya PDF.',
        ];

        $validasi = Validator::make($request->all(), $rules, $message);

        if ($validasi->fails()) {
            return back()
                ->with('add_fails', 'Data Gagal Ditambahkan.')
                ->withInput($request->except('key'))
                ->withErrors($validasi);
        } else {
            
            $data = SuratMasuk::create($request->all());
            if ($request->hasFile('file')) {
                $request->file('file')->move('FileSuratMasuk/', $request->file('file')->getClientOriginalName());
                $data->file = $request->file('file')->getClientOriginalName();
                $data->save();
            }

            return redirect()
                ->route('suratmasuk')
                ->with('add_success', 'Data Berhasil Ditambahkan.');
        }
    }

    public function hapus($id)
    {
        $data = SuratMasuk::find($id);
        $data->disposisi()->delete();

        if (File::exists(public_path('FileSuratMasuk/' . $data->file))) {
            File::delete(public_path('FileSuratMasuk/' . $data->file));
        }
        $data->delete();
        return redirect()
            ->route('suratmasuk')
            ->with('delete_success', 'Data Berhasil Dihapus.');
    }

    public function update(Request $request, $id)
    {

        $rules = [
            'no_surat' => Rule::unique('surat_masuks')->ignore($request->no_surat),
            'no_surat' => 'required',
            'jenis_surat_id' => 'required',
            'perihal' => 'required',
            'pengirim' => 'required',
            'tanggal_surat' => 'required|before_or_equal:' . date(DATE_ATOM),
            'tanggal_terima' => 'required|before_or_equal:' . date(DATE_ATOM),
            'file' => 'mimes:pdf',
        ];

        $message = [
            'no_surat.required' => 'Nomor surat harus diisi.',
            'jenis_surat_id.required' => 'Jenis surat harus diisi.',
            'perihal.required' => 'Perihal harus diisi.',
            'pengirim.required' => 'Pengirim harus diisi.',
            'tanggal_surat.required' => 'Tanggal surat harus diisi.',
            'tanggal_terima.required' => 'Tanggal terima harus diisi.',

            'no_surat.unique' => 'Nomor surat sudah ada.',
            'tanggal_surat.before_or_equal' => 'Tanggal surat tidak boleh lebih dari tanggal sekarang.',
            'tanggal_terima.before_or_equal' => 'Tanggal terima tidak boleh lebih dari tanggal sekarang.',
            'file.mimes' => 'Format file yang diterima hanya PDF.',
        ];
        
        $validasi = Validator::make($request->all(), $rules, $message);

        if ($validasi->fails()) {
            return redirect()
                ->route('suratmasuk')
                ->with('update_fails', 'Data Gagal Diubah.')
                ->withInput($request->except('key'))
                ->withErrors($validasi);
        } else {

            $data = SuratMasuk::find($id);
            $data->update($request->all());
            if ($request->hasFile('file')) {
                File::delete(public_path('FileSuratMasuk/' . $data->file));

                $request->file('file')->move('FileSuratMasuk/', $request->file('file')->getClientOriginalName());
                $data->file = $request->file('file')->getClientOriginalName();
                $data->save();
            }

            return redirect()
                ->route('suratmasuk')
                ->with('update_success', 'Data Berhasil Diubah.');
        }
    }

    public function exportexcel()
    {
        return Excel::download(new SuratMasukExport, 'laporan-surat-masuk.xlsx', null, $headers = ['no_surat', 'jenis_surat_id', 'perihal','pengirim','tanggal_surat', 'tanggal_terima']);
    }

    public function exportpdf()
    {
        $data = SuratMasuk::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('suratmasuk.templatPDF');

        return $pdf->download('laporan-surat-masuk.pdf');
    }
}
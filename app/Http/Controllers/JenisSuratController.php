<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use App\Models\JenisSurat;
use App\Models\Disposisi;
use File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SuratMasukExport;
use Illuminate\Support\Facades\DB;
use PDF;


class JenisSuratController extends Controller
{
    public function index()
    {
        $data = JenisSurat::all();
        return view('jenissurat.index', compact('data'));
        // view(folder.file, ...)
    }

    public function formTambah()
    {
        return view('jenissurat.formTambah');
    }

    public function tambah(Request $request)
    {
        $rules = [
            'id' => 'required|unique:jenis_surats,id',
            'nama_jenis' => 'required|unique:jenis_surats,nama_jenis',
            'keterangan' => 'required',
        ];

        $message = [
            'id.required' => 'Kode jenis surat harus diisi.',
            'nama_jenis.required' => 'Nama jenis surat harus diisi.',
            'keterangan.required' => 'Keterangan harus diisi.',

            'id.unique' => 'Kode jenis surat sudah ada.',
            'nama_jenis.unique' => 'Nama jenis surat sudah ada.',
        ];

        $validasi = Validator::make($request->all(), $rules, $message);

        if ($validasi->fails()) {
            return back()
                ->with('add_fails', 'Data Gagal Ditambahkan.')
                ->withInput($request->except('key'))
                ->withErrors($validasi);
        } else {
            
            $data = JenisSurat::create($request->all());
            return redirect()
                ->route('jenissurat')
                ->with('add_success', 'Data Berhasil Ditambahkan.');
        }
    }

    public function hapus($id)
    {
        $data = JenisSurat::find($id);
        $surats = DB::table('surat_masuks')->get()->where('jenis_surat_id', $id);
        foreach ($surats as $surat) {
            if (File::exists(public_path('FileSuratMasuk/' . $surat->file))) {
                File::delete(public_path('FileSuratMasuk/' . $surat->file));
            }
            $disposisi = DB::table('disposisis')->where('surat_masuk_id', $surat->id);
            if(is_null($disposisi) == false){
                $disposisi->delete();
            }
        }

        $data->surat_masuk()->delete();
        $data->delete();
        return redirect()
            ->route('jenissurat')
            ->with('delete_success', 'Data Berhasil Dihapus.');
    }

    public function update(Request $request, $id)
    {

        $rules = [
            'nama_jenis' => 'required',
            'id' => 'required',
            'keterangan' => 'required',
        ];

        $message = [
            'id.required' => 'Kode jenis surat harus diisi.',
            'nama_jenis.required' => 'Nama jenis surat harus diisi.',
            'keterangan.required' => 'Keterangan harus diisi.',

            'id.unique' => 'Kode jenis surat sudah ada.',
            'nama_jenis.unique' => 'Nama jenis surat sudah ada.',
        ];
        
        $validasi = Validator::make($request->all(), $rules, $message);
        if ($validasi->fails()) {
            return redirect()
                ->route('jenissurat')
                ->with('update_fails', 'Data Gagal Diubah.')
                ->withErrors($validasi);
        } else {

            $data = JenisSurat::find($id);
            $data->update($request->all());

            return redirect()
                ->route('jenissurat')
                ->with('update_success', 'Data Berhasil Diubah.');
        }
    }
}

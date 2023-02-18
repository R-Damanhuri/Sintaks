<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengolah;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PengolahController extends Controller
{
    public function index()
    {
        $data = Pengolah::all();
        $jabatan = Jabatan::all();
        return view('pengolah.index', compact('data', 'jabatan'));
        // view(folder.file, ...)
    }

    public function formTambah()
    {
        $jabatan = Jabatan::all();
        return view('pengolah.formTambah', compact('jabatan'));
    }

    public function tambah(Request $request)
    {
        $rules = [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pengolahs'],
            'fullname' => ['required', 'string', 'max:255'],
            'jabatan_id' => ['required'],
        ];

        $message = [
            'email.required' => 'E-mail harus diisi.',
            'fullname.required' => 'Nama lengkap harus diisi.',
            'jabatan_id.required' => 'Jabatan harus diisi.',

            'email.unique' => 'E-mail sudah ada.',
            'email.email' => 'Format e-mail salah.',
        ];

        $validasi = Validator::make($request->all(), $rules, $message);

        if ($validasi->fails()) {
            return back()
                ->with('add_fails', 'Data Gagal Ditambahkan.')
                ->withInput($request->except('key'))
                ->withErrors($validasi);
        } else {
            $data = Pengolah::create($request->all());
            return redirect()
                ->route('pengolah')
                ->with('add_success', 'Data Berhasil Ditambahkan.');
        }
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'email' => ['required', 'string', 'email', 'max:255'],
            'fullname' => ['required', 'string', 'max:255'],
            'jabatan_id' => ['required'],
        ];

        $message = [
            'email.required' => 'E-mail harus diisi.',
            'fullname.required' => 'Nama lengkap harus diisi.',
            'jabatan_id.required' => 'Jabatan harus diisi.',

            'email.email' => 'Format e-mail salah.',
        ];

        $validasi = Validator::make($request->all(), $rules, $message);

        if ($validasi->fails()) {
            return redirect()
                ->back()
                ->with('update_fails', 'Data Gagal Diubah.')
                ->withErrors($validasi);
        } else {
            $data = Pengolah::find($id);
            $data->update($request->all());

            return redirect()
                ->back()
                ->with('update_success', 'Data Berhasil Diubah.');
        }
    }

     public function hapus($id)
    {
        $data = Pengolah::find($id);
        $data->delete();
        return redirect()
            ->route('pengolah')
            ->with('delete_success', 'Data Berhasil Dihapus.');
    }
}
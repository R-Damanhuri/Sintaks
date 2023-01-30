<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class PenggunaController extends Controller
{
    public function index()
    {
        $data = User::all();
        $roles = Role::all();
        return view('pengguna.index', compact('data', 'roles'));
        // view(folder.file, ...)
    }

    public function formTambah()
    {
        $roles = Role::all();
        return view('pengguna.formTambah', compact('roles'));
    }

    public function tambah(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        $message = [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'E-mail harus diisi.',
            'password.required' => 'Password harus diisi.',

            'email.unique' => 'E-mail sudah ada.'
        ];

        $validasi = Validator::make($request->all(), $rules, $message);

        if ($validasi->fails()) {
            return back()
                ->with('add_fails', 'Data Gagal Ditambahkan.')
                ->withInput($request->except('key'))
                ->withErrors($validasi);
        } else {
            
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return redirect()
                ->route('pengguna')
                ->with('add_success', 'Data Berhasil Ditambahkan.');
        }
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255']
        ];

        $message = [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'E-mail harus diisi.'
        ];

        $validasi = Validator::make($request->all(), $rules, $message);

        if ($validasi->fails()) {
            return back()
                ->with('add_fails', 'Data Gagal Ditambahkan.')
                ->withInput($request->except('key'))
                ->withErrors($validasi);
        } else {
            
            $data = User::find($id);
            $data->update($request->all());
            return redirect()
                ->route('pengguna')
                ->with('add_success', 'Data Berhasil Ditambahkan.');
        }
    }

    public function hapus($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()
            ->route('pengguna')
            ->with('delete_success', 'Data Berhasil Dihapus.');
    }
}

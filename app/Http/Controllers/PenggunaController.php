<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use File;

class PenggunaController extends Controller
{
    public function index()
    {
        $data = User::where('role_id', 2)->get();
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
            'fullname' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'max:18'],
        ];

        $message = [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'E-mail harus diisi.',
            'password.required' => 'Password harus diisi.',
            'fullname.required' => 'Nama lengkap harus diisi.',
            'nip.required' => 'NIP harus diisi.',

            'email.unique' => 'E-mail sudah ada.',
            'email.email' => 'Format e-mail salah.',
            'password.min' => 'Password minimal menggunakan 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
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
                'fullname' => $request->fullname,
                'nip' => $request->nip,
                'foto' => 'pic-1.png',
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'fullname' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'max:18'],
            'foto' => ['mimes:jpg, png'],
        ];

        $message = [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'E-mail harus diisi.',
            'password.required' => 'Password harus diisi.',
            'fullname.required' => 'Nama lengkap harus diisi.',
            'nip.required' => 'NIP harus diisi.',

            'email.unique' => 'E-mail sudah ada.',
            'email.email' => 'Format e-mail salah.',
            'password.min' => 'Password minimal menggunakan 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',

            'foto.mimes' => 'Format file yang diperbolehkan adalah JPG dan PNG',
        ];

        $validasi = Validator::make($request->all(), $rules, $message);

        $validasi = Validator::make($request->all(), $rules, $message);
        if ($validasi->fails()) {
            return redirect()
                ->back()
                ->with('update_fails', 'Data Gagal Diubah.')
                ->withErrors($validasi);
        } else {
            $data = User::find($id);
            $data->update($request->all());
            if ($request->hasFile('foto')) {
                File::delete(public_path('assets/images/profile/' . $data->foto));

                $request->file('foto')->move('assets/images/profile/', $request->file('foto')->getClientOriginalName());
                $data->foto = $request->file('foto')->getClientOriginalName();
                $data->save();
            }

            return redirect()
                ->back()
                ->with('update_success', 'Data Berhasil Diubah.');
        }
    }

    public function hapus($id)
    {
        $data = User::find($id);
        if ($data->foto != 'pic-1.png') {
            if (File::exists(public_path('assets/images/profile/' . $data->foto))) {
                File::delete(public_path('assets/images/profile/' . $data->foto));
            }
        }
        $data->delete();
        return redirect()
            ->route('pengguna')
            ->with('delete_success', 'Data Berhasil Dihapus.');
    }
}

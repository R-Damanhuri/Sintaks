<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class PengaturanController extends Controller
{
    public function index($id)
    {
        $data = User::find($id);
        $roles = Role::all();
        return view('pengaturan.index', compact('data', 'roles'));
        // view(folder.file, ...)
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'fullname' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'max:18'],
            'foto' => ['mimes:jpg, png'],
        ]);

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

    public function password(Request $request, $id)
    {
        $rules = [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        $message = [
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal terdiri dari 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ];
        $validasi = Validator::make($request->all(), $rules, $message);

        if ($validasi->fails()) {
            return redirect()
                ->back()
                ->with('update_fails', 'Data Gagal Diubah.')
                ->withErrors($validasi);
        } else {
            $request['password'] = Hash::make($request->password);
            $data = User::find($id);
            $data->update($request->all());

            return redirect()
                ->back()
                ->with('update_success', 'Data Berhasil Diubah.');
        }
    }
}

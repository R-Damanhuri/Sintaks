@extends('layouts.app')

@section('title')
    Sintaks | Data Pengguna
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-account-multiple"></i>
            </span> Data Pengguna
        </h3>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Pengguna</h4>
                    <p class="card-description"> Isikan dengan data yang benar </p>

                    <form class="forms-sample" method="post" action="{{ route('pengguna.tambah') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-4">
                            <label class="col-sm-12 form-label"for="name">Username</label>
                            <input required id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-sm-12 form-label"for="email">E-mail</label>
                            <input required id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-sm-12 form-label"for="fullname">Nama Lengkap</label>
                            <input required id="fullname" type="text"
                                class="form-control @error('fullname') is-invalid @enderror" name="fullname"
                                value="{{ old('fullname') }}" required autocomplete="fullname" autofocus>
                            @error('fullname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-sm-12 form-label"for="nip">NIP</label>
                            <input required id="nip" type="text"
                                class="form-control @error('nip') is-invalid @enderror" name="nip"
                                value="{{ old('nip') }}" required autocomplete="nip" autofocus>
                            @error('nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="form-group mb-4">
                            <label class="col-sm-12 form-label" for="role_id">Role</label>
                            <select required class="form-control @error('role_id') is-invalid @enderror" name="role_id"
                                id="role_id">
                                <option value="">--- Pilih ---</option>
                                @foreach ($roles as $item)
                                    @if ($item->id != 1)
                                        <option value="{{ $item->id }}"
                                            @if (old('role_id') == $item->id) {{ 'selected' }} @endif>
                                            {{ $item->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('role_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        <div class="form-group mb-4">
                            <label class="col-sm-12 form-label"for="password">Password</label>
                            <input required id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-sm-12 form-label"for="confirm_password">Konfirmasi Password</label>
                            <input required id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <button type="submit" class="btn btn-gradient-primary me-2">Tambah</button>
                        <a href="{{ route('pengguna') }}" class="btn btn-danger">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Gagal Tambah Surat --}}
    @if ($message = Session::get('add_fails'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Data gagal ditambahkan.',
                timer: 1000,
                showConfirmButton: false,
            })
        </script>
    @endif
@endsection

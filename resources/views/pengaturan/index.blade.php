@extends('layouts.app')

@section('title')
    Sintaks | Pengaturan
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-settings"></i>
            </span>
            <span class="page-title-text">
                Pengaturan
            </span>
        </h3>
    </div>
    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Informasi General</h4>
                    <div class="row">
                        <div class="col-3 text-center">
                            <img class="border-primary border-3 border img-xl rounded-circle"
                                src="../assets/images/profile/{{ $data->foto }}" alt="image">
                        </div>

                        {{-- Include Modal --}}
                        @include('pengaturan.modal')

                        <div class="col-9">
                            <div class="row">
                                <div class="col-4">
                                    <p>Username</p>
                                </div>
                                <div class="col-8">
                                    <p>: {{ $data->name }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p>Nama Lengkap</p>
                                </div>
                                <div class="col-8">
                                    <p>: {{ $data->fullname }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p>NIP</p>
                                </div>
                                <div class="col-8">
                                    <p>: {{ $data->nip }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p>Role</p>
                                </div>
                                <div class="col-8">
                                    <p>: {{ $data->role->name }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p>E-mail</p>
                                </div>
                                <div class="col-8">
                                    <p>: {{ $data->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="mt-3">
                            <button class="btn-gradient-primary btn" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $data->id }}">Edit Profil</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Password</h4>
                    <div class="row">
                        <form class="forms-sample" method="post" action="/pengaturan/password/{{ $data->id }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-4">
                                <label class="col-sm-12 form-label"for="password">Password Baru</label>
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

                            <div class="text-center">
                                <button type="submit" class="btn btn-gradient-primary me-2">Ubah Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SweetAlert Sukses Update Surat --}}
    @if ($message = Session::get('update_success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data berhasil diubah.',
                timer: 1000,
                showConfirmButton: false,
            })
        </script>
    @endif
@endsection

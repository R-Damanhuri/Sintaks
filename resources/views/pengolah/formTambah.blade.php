@extends('layouts.app')

@section('title')
    Sintaks | Data Pengolah
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-account-multiple"></i>
            </span> Data Pengolah
        </h3>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Pengolah</h4>
                    <p class="card-description"> Isikan dengan data yang benar </p>

                    <form class="forms-sample" method="post" action="{{ route('pengolah.tambah') }}"
                        enctype="multipart/form-data">
                        @csrf

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
                            <label class="col-sm-12 form-label"for="email">E-mail</label>
                            <input required id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label class="col-sm-12 form-label" for="jabatan_id">Jabatan</label>
                            <select required class="form-control @error('jabatan_id') is-invalid @enderror"
                                name="jabatan_id" id="jabatan_id">
                                <option value="">--- Pilih ---</option>
                                @foreach ($jabatan as $item)
                                    <option value="{{ $item->id }}"
                                        @if (old('jabatan_id') == $item->id) {{ 'selected' }} @endif>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jabatan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-gradient-primary me-2">Tambah</button>
                        <a href="{{ route('pengolah') }}" class="btn btn-danger">Batal</a>
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

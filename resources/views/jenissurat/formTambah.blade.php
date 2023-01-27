@extends('layouts.app')

@section('title')
    Sintaks | Jenis Surat
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-view-grid"></i>
            </span> Jenis Surat
        </h3>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Jenis</h4>
                    <p class="card-description"> Isikan dengan data yang benar </p>

                    <form class="forms-sample" method="post" action="/jenissurat/tambah" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label class="col-sm-3 col-form-label"for="id">Kode Jenis Surat</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control @error('id') is-invalid @enderror"
                                    name="id" id="id" placeholder="Kode Surat" value="{{ old('id') }}">
                                @error('id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-form-label"for="nama_jenis">Jenis Surat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('nama_jenis') is-invalid @enderror"
                                    name="nama_jenis" id="nama_jenis" placeholder="Jenis Surat" value="{{ old('nama_jenis') }}">
                                @error('nama_jenis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-form-label"for="keterangan">Keterangan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                    name="keterangan" id="keterangan" placeholder="keterangan" value="{{ old('keterangan') }}">
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-gradient-primary me-2">Tambah</button>
                        <a href="{{ route('jenissurat') }}" class="btn btn-danger">Batal</a>
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

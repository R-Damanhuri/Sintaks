@extends('layouts.app')

@section('title')
    Sintaks | Surat Masuk
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-email-open"></i>
            </span> Surat Masuk
        </h3>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Surat</h4>
                    <p class="card-description"> Isikan dengan data yang benar </p>

                    <form class="forms-sample" method="post" action="/suratmasuk/tambah" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"for="no_surat">Nomor Surat</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('no_surat') is-invalid @enderror"
                                            name="no_surat" id="no_surat" placeholder="Nomor Surat"
                                            value="{{ old('no_surat') }}">
                                        @error('no_surat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"for="pengirim">Pengirim</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('pengirim') is-invalid @enderror"
                                            name="pengirim" id="pengirim" placeholder="Pengirim"
                                            value="{{ old('pengirim') }}">
                                        @error('pengirim')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"for="jenis_id">Jenis Surat</label>
                                    <div class="col-sm-9">
                                        <select class="form-control mt-2 @error('jenis_id') is-invalid @enderror"
                                            name="jenis_id" id="jenis_id">
                                            <option value="">--- Pilih ---</option>
                                            @foreach ($jenis as $item)
                                                <option value="{{ $item->id }}"
                                                    @if (old('jenis_id')== $item->id)
                                                        {{'selected'}}
                                                    @endif
                                                    >
                                                    {{ $item->nama_jenis }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('jenis_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"for="tanggal_surat">Tanggal Surat</label>
                                    <div class="col-sm-9">
                                        <input type="date"
                                            class="form-control @error('tanggal_surat') is-invalid @enderror"
                                            name="tanggal_surat" id="tanggal_surat" placeholder="dd/mm/yyyy"
                                            value="{{ old('tanggal_surat') }}">
                                        @error('tanggal_surat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"for="perihal">Perihal</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('perihal') is-invalid @enderror"
                                            name="perihal" id="perihal" placeholder="Perihal"
                                            value="{{ old('perihal') }}">
                                        @error('perihal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"for="tanggal_terima">Tanggal Terima</label>
                                    <div class="col-sm-9">
                                        <input type="date"
                                            class="form-control @error('tanggal_terima') is-invalid @enderror"
                                            name="tanggal_terima" id="tanggal_terima" placeholder="dd/mm/yyyy"
                                            value="{{ old('tanggal_terima') }}">
                                        @error('tanggal_terima')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"for="file">File</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control @error('file') is-invalid @enderror"
                                            name="file" id="file" value="{{ old('file') }}">
                                        @error('file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">

                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                        <a href="{{ route('suratmasuk') }}" class="btn btn-danger">Batal</a>
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

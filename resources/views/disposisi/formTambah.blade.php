@extends('layouts.app')

@section('title')
    Sintaks | Disposisi
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-send"></i>
            </span> Disposisi
        </h3>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Disposisi</h4>
                    <p class="card-description"> Isikan dengan data yang benar </p>

                    <form onsubmit="kepada.value = pengolah.value" class="forms-sample" method="post"
                        action="/disposisi/tambah" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-4">
                            <label class="col-sm-12 form-label" for="surat_masuk_id">Nomor Surat Masuk</label>
                            <select required class="form-control @error('surat_masuk_id') is-invalid @enderror"
                                name="surat_masuk_id" id="surat_masuk_id">
                                <option value="">--- Pilih ---</option>
                                @foreach ($surat as $item)
                                    <option value="{{ $item->id }}"
                                        @if (old('surat_masuk_id') == $item->id) {{ 'selected' }} @endif>
                                        {{ $item->no_surat }}
                                    </option>
                                @endforeach
                            </select>
                            @error('surat_masuk_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-sm-12 form-label" for="id">Intruksi</label>
                            <select required class="form-control mt-2 @error('intruksi') is-invalid @enderror"
                                name="intruksi" id="intruksi">
                                <option value="">--- Pilih ---</option>
                                <option value="Untuk diketahui"
                                    @if (old('intruksi') == 'Untuk diketahui') {{ 'selected' }} @endif>
                                    Untuk diketahui
                                </option>
                                <option value="Untuk dipertimbangkan"
                                    @if (old('intruksi') == 'Untuk dipertimbangkan') {{ 'selected' }} @endif>
                                    Untuk dipertimbangkan
                                </option>
                                <option value="Untuk diselesaikan lebih lanjut"
                                    @if (old('intruksi') == 'Untuk diselesaikan lebih lanjut') {{ 'selected' }} @endif>
                                    Untuk diselesaikan lebih lanjut
                                </option>
                                <option value="Untuk dilaksanakan penuh tanggung jawab"
                                    @if (old('intruksi') == 'Untuk dilaksanakan penuh tanggung jawab') {{ 'selected' }} @endif>
                                    Untuk dilaksanakan penuh tanggung jawab
                                </option>
                                <option value="Diusahakan untuk mengikuti"
                                    @if (old('intruksi') == 'Diusahakan untuk mengikuti') {{ 'selected' }} @endif>
                                    Diusahakan untuk mengikuti
                                </option>
                                <option value="Tugas sekolah diatur sebaik-baiknya dengan guru piket"
                                    @if (old('intruksi') == 'Tugas sekolah diatur sebaik-baiknya dengan guru piket') {{ 'selected' }} @endif>
                                    Tugas sekolah diatur sebaik-baiknya dengan guru piket
                                </option>
                                <option value="Untuk dikonfirmasikan dengan pihak terkait"
                                    @if (old('intruksi') == 'Untuk dikonfirmasikan dengan pihak terkait') {{ 'selected' }} @endif>
                                    Untuk dikonfirmasikan dengan pihak terkait
                                </option>
                                <option value="Diteruskan kepada yang bersangkutan"
                                    @if (old('intruksi') == 'Diteruskan kepada yang bersangkutan') {{ 'selected' }} @endif>
                                    Diteruskan kepada yang bersangkutan
                                </option>
                                <option value="Untuk dikopi dan dipasang di Papan Pengumuman"
                                    @if (old('intruksi') == 'Untuk dikopi dan dipasang di Papan Pengumuman') {{ 'selected' }} @endif>
                                    Untuk dikopi dan dipasang di Papan Pengumuman
                                </option>
                                <option value="Untuk dilengkapi Surat Tugas/SPPD/Dispensasi"
                                    @if (old('intruksi') == 'Untuk dilengkapi Surat Tugas/SPPD/Dispensasi') {{ 'selected' }} @endif>
                                    Untuk dilengkapi Surat Tugas/SPPD/Dispensasi
                                </option>
                                <option value="Disiapkan untuk bahan briefing"
                                    @if (old('intruksi') == 'Disiapkan untuk bahan briefing') {{ 'selected' }} @endif>
                                    Disiapkan untuk bahan briefing
                                </option>
                            </select>
                            @error('intruksi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-sm-12 form-label"for="catatan">Catatan</label>
                            <input type="text" class="form-control @error('catatan') is-invalid @enderror"
                                name="catatan" id="catatan" placeholder="Catatan (opsional)"
                                value="{{ old('catatan') }}">
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4" id="daftar">
                            <label class="col-sm-12 form-label"for="kepada">Daftar Penerima</label>

                            <div class="col-sm-12 form-control" id="isi">
                                <div class="overflow-auto" style="max-height: 220px;">
                                    <div class="row">
                                        @php $count = 0 @endphp
                                        @foreach ($pengolah as $item)
                                            @if ($count % 3 == 0)
                                    </div>
                                    <div class="row">
                                        @endif
                                        <div class="col-4">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input
                                                        class="checkbox @if (old('kepada') == $item->fullname) {{ 'checked' }} @endif"
                                                        type="checkbox" value="{{ $item->id }}" name="kepada[]">
                                                    {{ $item->fullname . ' ( ' . $item->jabatan->name . ' )' }}
                                                </label>
                                            </div>
                                        </div>
                                        @php $count++ @endphp
                                        @endforeach
                                    </div>

                                    @error('kepada')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" id="tambah" class="btn btn-gradient-primary me-2">Tambah</button>
                        <a href="{{ route('disposisi') }}" class="btn btn-danger">Batal</a>
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

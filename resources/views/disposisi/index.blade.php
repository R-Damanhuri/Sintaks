@extends('layouts.app')

@section('title')
    Sintaks | Disposisi
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-send"></i>
            </span>
            <span class="page-title-text">
                Disposisi
            </span>
        </h3>
        <div class="text-end">

            <button onclick="location.href='{{ route('disposisi.formTambah') }}'"
                class="btn-sm btn-gradient-primary ms-1 my-1 rounded-3"><i class="mdi mdi-plus icon-sm"></i> Tambah
                Disposisi</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Intruksi</th>
                                <th>Daftar Penerima</th>
                                <th>Nomor Surat</th>
                                <th>Catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->intruksi }}</td>
                                    <td>{{ $row->kepada }}</td>
                                    <td>{{ $row->surat_masuk->no_surat }}</td>
                                    <td>{{ $row->catatan }}</td>
                                    <td>
                                        <a title="Cetak" href="/disposisi/exportpdf/{{$row->id}}" class="btn-sm btn-info edit ms-1"><i
                                                class="mdi mdi-printer"></i></a>
                                        <a title="Ubah" href="#" class="btn-sm btn-warning edit ms-1" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $row->id }}"><i
                                                class="mdi mdi-pencil"></i></a>
                                        <a title="Hapus" href="#" class="btn-sm btn-danger delete ms-1"
                                            data-id="{{ $row->id }}" data-nomor="{{ $row->surat_masuk->no_surat }}"><i
                                                class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>

                                {{-- Include Modal --}}
                                @include('disposisi.modal')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- SweetAlert Sukses Tambah Surat --}}
    @if ($message = Session::get('add_success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data berhasil ditambahkan.',
                timer: 1000,
                showConfirmButton: false,
            })
        </script>
    @endif

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

    {{-- SweetAlert Hapus --}}
    <script>
        $('.delete').click(function() {
            var id = $(this).attr('data-id');
            var nomor = $(this).attr('data-nomor');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Disposisi untuk surat bernomor " + nomor + " akan dihapus.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/disposisi/hapus/" + id + ""
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Disposisi berhasil dihapus.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
            })
        })
    </script>
@endsection

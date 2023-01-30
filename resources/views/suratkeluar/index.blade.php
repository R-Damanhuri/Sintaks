@extends('layouts.app')

@section('title')
    Sintaks | Surat Keluar
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-email-open"></i>
            </span>
            <span class="page-title-text">
                Surat Keluar
            </span>
        </h3>
        <div class="text-end">

            <button onclick="location.href='{{ route('suratkeluar.formTambah') }}'"
                class="btn-sm btn-gradient-primary ms-1 my-1 rounded-3"><i class="mdi mdi-plus icon-sm"></i> Tambah
                Surat</button>
            <button onclick="location.href = '{{ route('suratkeluar.exportpdf') }}' "
                class="btn-sm btn-gradient-danger ms-1 my-1 rounded-3"><i class="mdi mdi-file-pdf icon-sm"></i>
                PDF</button>
            <button onclick="location.href = '{{ route('suratkeluar.exportexcel') }}' "
                class="btn-sm btn-gradient-success ms-1 my-1 rounded-3"><i class="mdi mdi-file-excel icon-sm"></i>
                Excel</button>
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
                                <th>No. Surat</th>
                                <th>Jenis Surat</th>
                                <th>Perihal</th>
                                <th>Penerima</th>
                                <th>Tanggal Surat</th>
                                {{-- <th>Terakhir Diubah</th> --}}
                                <th>File</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->no_surat }}</td>
                                    <td>{{ $row->jenis_surat->nama_jenis }}</td>
                                    <td>{{ $row->perihal }}</td>
                                    <td>{{ $row->penerima }}</td>
                                    <td>{{ date('d-m-Y', strtotime($row->tanggal_surat)) }}</td>
                                    {{-- <td>{{ $row->updated_at->diffForHumans() }}</td> --}}
                                    <td>
                                        <a title="Lihat Berkas" href="" class="btn-sm btn-info " id="pdf" data-bs-toggle="modal"
                                            data-bs-target="#pdfModal{{ $row->id }}"><i class="mdi mdi-file"></i></a>
                                    </td>
                                    <td>
                                        <a title="Ubah" href="#" class="btn-sm btn-warning edit ms-1" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $row->id }}"><i
                                                class="mdi mdi-pencil"></i></a>
                                        <a title="Hapus" href="#" class="btn-sm btn-danger delete ms-1"
                                            data-nomor="{{ $row->no_surat }} " data-id="{{ $row->id }}"><i
                                                class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>

                                {{-- Include Modal --}}
                                @include('suratkeluar.modal')
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
            var nomor = $(this).attr('data-nomor');
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Surat keluar dengan nomor " + nomor + " akan dihapus.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/suratkeluar/hapus/" + id + ""
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Surat keluar berhasil dihapus.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
            })
        })
    </script>
@endsection

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
        <div class="text-end">

            <button onclick="location.href='{{ route('jenissurat.formTambah') }}'"
                class="btn-sm btn-gradient-primary ms-1 my-1 rounded-3"><i class="mdi mdi-plus icon-sm"></i> Tambah
                Jenis</button>
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
                                <th>Kode Jenis Surat</th>
                                <th>Jenis Surat</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->nama_jenis }}</td>
                                    <td>{{ $row->keterangan }}</td>
                                    <td>
                                        <a title="Ubah" href="#" class="btn-sm btn-warning edit ms-1" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $row->id }}"><i
                                                class="mdi mdi-pencil"></i></a>
                                        <a title="Hapus" href="#" class="btn-sm btn-danger delete ms-1"
                                            data-jenis="{{ $row->nama_jenis }} " data-id="{{ $row->id }}"><i
                                                class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>

                                {{-- Include Modal --}}
                                @include('jenissurat.modal')
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
            var jenis = $(this).attr('data-jenis');
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Semua surat dan disposisi dengan jenis " + jenis + " juga akan terhapus.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/jenissurat/hapus/" + id + ""
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Surat masuk berhasil dihapus.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
            })
        })
    </script>
@endsection

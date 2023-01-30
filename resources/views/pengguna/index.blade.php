@extends('layouts.app')

@section('title')
    Sintaks | Data Pengguna
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-account-multiple"></i>
            </span>
            <span class="page-title-text">
                Data Pengguna
            </span>
        </h3>
        <div class="text-end">
            <button onclick="location.href='{{ route('pengguna.formTambah') }}'"
                class="btn-sm btn-gradient-primary ms-1 my-1 rounded-3"><i class="mdi mdi-plus icon-sm"></i> Tambah
                Pengguna</button>
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
                                <th>Username</th>
                                <th>E-mail</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->role->name }}</td>
                                    <td>
                                        <a title="Ubah" href="#" class="btn-sm btn-warning edit ms-1"
                                            data-bs-toggle="modal" data-bs-target="#editModal{{ $row->id }}"><i
                                                class="mdi mdi-pencil"></i></a>

                                        @if ($row->role_id == 2)
                                            <a title="Hapus" href="#" class="btn-sm btn-danger delete ms-1"
                                                data-username="{{ $row->name }} " data-id="{{ $row->id }}"><i
                                                    class="mdi mdi-delete"></i></a>
                                        @endif
                                    </td>
                                </tr>

                                {{-- Include Modal --}}
                                @include('pengguna.modal')
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
            var username = $(this).attr('data-username');
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Pengguna dengan username " + username + " akan dihapus.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/pengguna/hapus/" + id + ""
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data pengguna berhasil dihapus.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
            })
        })
    </script>
@endsection

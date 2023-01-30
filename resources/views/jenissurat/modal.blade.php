{{-- Modal Edit --}}
<div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Jenis Surat</h5>
                <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form class="forms-sample" id="modal-form" method="post"
                    action="/jenissurat/update/{{ $row->id }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="col-sm-12 col-form-label"for="id">Kode Jenis Surat</label>
                        <div class="col-sm-12">
                            <input required type="text" class="form-control @error('id') is-invalid @enderror"
                                name="id" id="id" placeholder="Kode Jenis Surat" value="{{ old('id', $row->id) }}">
                            @error('id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label"for="nama_jenis">Nama Jenis Surat</label>
                        <div class="col-sm-12">
                            <input required type="text" class="form-control @error('nama_jenis') is-invalid @enderror"
                                name="nama_jenis" id="nama_jenis" placeholder="Jenis Surat" value="{{ old('nama_jenis', $row->nama_jenis) }}">
                            @error('nama_jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label"for="keterangan">Keterangan</label>
                        <div class="col-sm-12">
                            <input required type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                name="keterangan" id="keterangan" placeholder="Keterangan" value="{{ old('keterangan', $row->keterangan) }}">
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" id="ubah" class="btn btn-gradient-primary me-2">Ubah</button>
                    <a href="{{ route('jenissurat') }}" class="btn btn-danger">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Sweet Alert Gagal Update Surat --}}
@if ($message = Session::get('update_fails'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Data gagal diubah.',
            timer: 1000,
            showConfirmButton: false,
        })
    </script>
@endif

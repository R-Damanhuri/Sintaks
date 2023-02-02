{{-- Modal PDF Viewer --}}
<div class="modal fade" id="pdfModal{{ $row->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">File Surat Keluar</h5>
                <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <embed src="{{ asset('FileSuratKeluar/' . $row->file) }}" frameborder="0" width="100%" height="500px">
            </div>
        </div>
    </div>
</div>

{{-- Modal Edit --}}
<div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Surat Keluar</h5>
                <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form class="forms-sample" id="modal-form" method="post"
                    action="/suratkeluar/update/{{ $row->id }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="no_surat">Nomor Surat</label>
                        <input required readonly type="text" class="form-control @error('no_surat') is-invalid @enderror"
                            name="no_surat" id="no_surat" placeholder="Nomor Surat"
                            value="{{ old('no_surat', $row->no_surat) }}">
                        @error('no_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis_id">Jenis Surat</label>
                        <select required class="form-control @error('jenis_surat_id') is-invalid @enderror" name="jenis_surat_id"
                            id="jenis_surat_id">
                            <option value="">--- Pilih ---</option>
                            @foreach ($jenis as $item)
                                <option value="{{ $item->id }}"
                                    @if ($row->jenis_surat_id == $item->id) {{ 'selected' }} @endif>
                                    {{ $item->nama_jenis }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="perihal">Perihal</label>
                        <input required type="text" class="form-control @error('perihal') is-invalid @enderror" name="perihal"
                            id="perihal" placeholder="Perihal" value=" {{ old('perihal',$row->perihal) }}">
                        @error('perihal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="penerima">Penerima</label>
                        <input required type="text" class="form-control @error('penerima') is-invalid @enderror"
                            name="penerima" id="penerima" placeholder="Penerima"
                            value="{{ old('penerima',$row->penerima) }}">
                        @error('penerima')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal_surat">Tanggal Surat</label>
                        <input required type="date" class="form-control @error('tanggal_surat') is-invalid @enderror"
                            name="tanggal_surat" id="tanggal_surat" placeholder="dd/mm/yyyy"
                            value="{{ old('tanggal_surat',$row->tanggal_surat) }}">
                        @error('tanggal_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" name="file"
                            id="file" value="{{ old('file',$row->file) }}">
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" id="ubah" class="btn btn-gradient-primary me-2">Ubah</button>
                    <a href="{{ route('suratkeluar') }}" class="btn btn-danger">Batal</a>
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
            showConfirmButton: false,
            timer: 1000
        })
    </script>
@endif

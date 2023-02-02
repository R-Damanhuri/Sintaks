{{-- Modal Edit --}}
<div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Disposisi</h5>
                <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form class="forms-sample" method="post" action="/disposisi/update/{{ $row->id }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-4">
                        <label class="col-sm-12 form-label" for="surat_masuk_id">Nomor Surat Masuk</label>
                        <select required readonly
                            class="form-control mt-2 @error('surat_masuk_id') is-invalid @enderror"
                            name="surat_masuk_id" id="surat_masuk_id">
                            <option value="">--- Pilih ---</option>
                            <option value="{{ $row->surat_masuk->id }}" selected>
                                {{ $row->surat_masuk->no_surat }}
                            </option>
                        </select>
                        @error('surat_masuk_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-sm-12 form-label"for="id">Intruksi</label>
                        <select required class="form-control @error('intruksi') is-invalid @enderror" name="intruksi"
                            id="intruksi">
                            <option value="">--- Pilih ---</option>
                            <option value="Untuk diketahui"
                                @if ($row->intruksi == 'Untuk diketahui') {{ 'selected' }} @endif>
                                Untuk diketahui
                            </option>
                            Untuk dipertimbangkan
                            </option>
                            <option value="Untuk diselesaikan lebih lanjut"
                                @if ($row->intruksi == 'Untuk diselesaikan lebih lanjut') {{ 'selected' }} @endif>
                                Untuk diselesaikan lebih lanjut
                            </option>
                            <option value="Untuk dilaksanakan penuh tanggung jawab"
                                @if ($row->intruksi == 'Untuk dilaksanakan penuh tanggung jawab') {{ 'selected' }} @endif>
                                Untuk dilaksanakan penuh tanggung jawab
                            </option>
                            <option value="Diusahakan untuk mengikuti"
                                @if ($row->intruksi == 'Diusahakan untuk mengikuti') {{ 'selected' }} @endif>
                                Diusahakan untuk mengikuti
                            </option>
                            <option value="Tugas sekolah diatur sebaik-baiknya dengan guru piket"
                                @if ($row->intruksi == 'Tugas sekolah diatur sebaik-baiknya dengan guru piket') {{ 'selected' }} @endif>
                                Tugas sekolah diatur sebaik-baiknya dengan guru piket
                            </option>
                            <option value="Untuk dikonfirmasikan dengan pihak terkait"
                                @if ($row->intruksi == 'Untuk dikonfirmasikan dengan pihak terkait') {{ 'selected' }} @endif>
                                Untuk dikonfirmasikan dengan pihak terkait
                            </option>
                            <option value="Diteruskan kepada yang bersangkutan"
                                @if ($row->intruksi == 'Diteruskan kepada yang bersangkutan') {{ 'selected' }} @endif>
                                Diteruskan kepada yang bersangkutan
                            </option>
                            <option value="Untuk dikopi dan dipasang di Papan Pengumuman"
                                @if ($row->intruksi == 'Untuk dikopi dan dipasang di Papan Pengumuman') {{ 'selected' }} @endif>
                                Untuk dikopi dan dipasang di Papan Pengumuman
                            </option>
                            <option value="Untuk dilengkapi Surat Tugas/SPPD/Dispensasi"
                                @if ($row->intruksi == 'Untuk dilengkapi Surat Tugas/SPPD/Dispensasi') {{ 'selected' }} @endif>
                                Untuk dilengkapi Surat Tugas/SPPD/Dispensasi
                            </option>
                            <option value="Disiapkan untuk bahan briefing"
                                @if ($row->intruksi == 'Disiapkan untuk bahan briefing') {{ 'selected' }} @endif>
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
                            name="catatan" id="catatan" placeholder="Catatan (opsional)" value="{{ $row->catatan }}">
                        @error('catatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-sm-12 form-label"for="kepada">Daftar Penerima</label>
                        <input required type="text" class="form-control @error('kepada') is-invalid @enderror"
                            name="kepada" id="kepada" placeholder="Kepada" value="{{ $row->kepada }}">
                        @error('kepada')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                    <a href="{{ route('disposisi') }}" class="btn btn-danger">Batal</a>
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

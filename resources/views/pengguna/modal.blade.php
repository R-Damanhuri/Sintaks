{{-- Modal Edit --}}
<div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Pengguna</h5>
                <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form class="forms-sample" id="modal-form" method="post"
                    action="/pengguna/update/{{ $row->id }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="col-sm-12 col-form-label"for="id">Nama</label>
                        <div class="col-sm-12">
                            <input required type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" id="name" placeholder="Nama" value="{{ old('name', $row->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label"for="email">E-mail</label>
                        <div class="col-sm-12">
                            <input required id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $row->email) }}" required autocomplete="email">

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    @if ($row->role_id == 2)
                    <div class="form-group">
                        <label for="role_id">Role</label>
                        <select required class="form-control mt-2 @error('role_id') is-invalid @enderror"
                            name="role_id" id="role_id">
                            <option value="">--- Pilih ---</option>
                            @foreach ($roles as $item)
                                <option value="{{ $item->id }}"
                                    @if ($row->role_id == $item->id) {{ 'selected' }} @endif>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif

                    <button type="submit" id="ubah" class="btn btn-gradient-primary me-2">Ubah</button>
                    <a href="{{ route('pengguna') }}" class="btn btn-danger">Batal</a>
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

{{-- Modal Edit --}}
<div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Profil</h5>
                <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form class="forms-sample" id="modal-form" method="post"
                    action="/pengaturan/update/{{ $data->id }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-4">
                        <label class="col-sm-12 form-label" for="name">Username</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name', $data->name) }}" required autocomplete="name"
                            autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label class="col-sm-12 form-label"for="fullname">Nama Lengkap</label>
                        <input id="fullname" type="text"
                            class="form-control @error('fullname') is-invalid @enderror" name="fullname"
                            value="{{ old('fullname', $data->fullname) }}" required autocomplete="fullname" autofocus>
                        @error('fullname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label class="col-sm-12 form-label"for="nip">NIP</label>
                        <input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror"
                            name="nip" value="{{ old('nip', $data->nip) }}" required autocomplete="nip" autofocus>
                        @error('nip')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label class="col-sm-12 form-label" for="role_id">Role</label>
                        <select disabled required class="form-control @error('role_id') is-invalid @enderror" name="role_id"
                            id="role_id">
                            <option value="">--- Pilih ---</option>
                            @foreach ($roles as $item)
                                <option value="{{ $item->id }}"
                                    @if ($data->role_id == $item->id) {{ 'selected' }} @endif>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label class="col-sm-12 form-label"for="email">E-mail</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email', $data->email) }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label class="col-sm-12 form-label"for="foto">Foto</label>
                        <input id="foto" type="file" class="form-control @error('foto') is-invalid @enderror"
                            name="foto" value="{{ old('foto', $data->foto) }}" autocomplete="foto">
                        @error('foto')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" id="ubah" class="btn btn-gradient-primary me-2">Ubah</button>
                    <a href="/pengaturan/{{ $data->id }}" class="btn btn-danger">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Sweet Alert Gagal Update Data --}}
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

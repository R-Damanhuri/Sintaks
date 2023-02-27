@extends('layouts.loginapp')

@section('title')
    Sintaks | Login
@endsection

@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth bg-login"
                style="background-image: url({{ asset('/assets/images/background2.jpg') }}); background-position: center; background-size: cover;">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-center p-5">
                            <div class="brand-logo">
                                <img class="sc-1" src="{{ asset('/assets/images/logo.svg') }}">
                                <p class="font-weight-light text-small mt-2">Sistem Informasi Tata Kelola Surat</p>
                            </div>
                            <h4>Selamat Datang</h4>
                            <h6 class="font-weight-light">Silakan login untuk melanjutkan.</h6>

                            <form class="pt-3" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email"
                                        class="form-control @error('email') is-invalid @enderror form-control-lg"
                                        placeholder="E-mail" id="email" name="email" value="{{ old('email') }}"
                                        required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback text-start" role="alert">
                                            <p>{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password"
                                        class="form-control @error('password') is-invalid @enderror form-control-lg"
                                        placeholder="Password" id="password" name="password" required
                                        autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="card-subtitle d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label text-muted" for="remember">
                                            {{ __('Ingat saya') }}
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="auth-link text-black" href="{{ route('password.request') }}">
                                            {{ __('Lupa password?') }}
                                        </a>
                                    @endif
                                </div>
                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    {{-- SweetAlert Sukses Link Reset --}}
    @if ($message = Session::get('status'))
        <script>
            Swal.fire({
                // position: 'top',
                icon: 'success',
                title: 'Berhasil!',
                text: 'Link reset password berhasil dikirim.',
                timer: 1500,
                showConfirmButton: false,
            })
        </script>
    @endif
@endsection

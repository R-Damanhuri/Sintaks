@extends('layouts.loginapp')

@section('title')
    Sintaks | Reset Password
@endsection

@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex auth">
                <div class="row flex-grow">
                    <div class="col-md-6 mx-auto">
                        <div class="card mt-5">
                            <div class="card-header">{{ __('Reset Password') }} </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="email"
                                            class="col-md-4 col-form-label text-md-end">{{ __('E-mail') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-12 text-center ms-4">
                                            <button type="submit" class="btn btn-primary my-1 mx-1 ms-3">
                                                Kirim
                                            </button>
                                            <a href="{{ route('login') }}" class="btn btn-danger my-1 mx-1">Batal</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection

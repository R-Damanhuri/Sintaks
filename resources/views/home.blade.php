@extends('layouts.app')

@section('title')
    Sintaks | Dashboard
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Dashboard
        </h3>
    </div>
    <div class="row">
        <div class="col-md-4 grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h3 class="font-weight-normal mb-3">Surat Masuk <i class="mdi mdi-email-open icon-md float-end"></i>
                    </h3>
                    <h1>{{ $jml_sm }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4 grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h3 class="font-weight-normal mb-3">Surat Keluar <i class="mdi mdi-email icon-md float-end"></i>
                    </h3>
                    <h1>{{ $jml_sk }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4 grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h3 class="font-weight-normal mb-3">Pengarsip <i class="mdi mdi-account-group icon-md float-end"></i>
                    </h3>
                    <h1>{{ $jml_users }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Statitik Bulan Ini</h4>
                    <canvas id="traffic-chart" data-sm-bln="{{ $sm_bln }}" data-sk-bln="{{ $sk_bln }}"></canvas>
                    <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="clearfix">
                        <h4 class="card-title float-left">Statistik Tahun Ini</h4>
                        <div id="traffic-year-chart-legend"
                            class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div>
                    <canvas id="traffic-year-chart" data-sk-th="@php echo json_encode($sk_th); @endphp"
                        data-sm-th="@php echo json_encode($sm_th); @endphp" class="mt-4"></canvas>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Jenis Surat Masuk Tahun Ini</h4>
                    <canvas id="jenis-sm-chart" data-sm-jns-count="@php echo json_encode($sm_jns_count); @endphp"
                        data-sm-jns-name="@php echo json_encode($sm_jns_name); @endphp"></canvas>
                    <div id="jenis-sm-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Jenis Surat Keluar Tahun Ini</h4>
                    <canvas id="jenis-sk-chart" data-sk-jns-count="@php echo json_encode($sk_jns_count); @endphp"></canvas>
                    <div id="jenis-sk-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
                </div>
            </div>
        </div>
    </div>

    @if ($message = Session::get('status'))
        <script>
            Swal.fire({
                // position: 'top',
                icon: 'success',
                title: 'Berhasil!',
                text: 'Password berhasil direset.',
                timer: 1500,
                showConfirmButton: false,
            })
        </script>
    @endif
@endsection

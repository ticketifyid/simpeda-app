@extends('superadmin.layouts.app')

@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar pt-5 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack flex-wrap">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        Dashboard</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">

            {{-- Alert error --}}
            @if (isset($error))
                <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                    <i class="ki-outline ki-information-5 fs-2hx text-danger me-4"></i>
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-danger">Gagal memuat data</h4>
                        <span>{{ $error }}</span>
                    </div>
                </div>
            @endif

            {{-- ===== Section Header ===== --}}
            <div class="d-flex align-items-center justify-content-between mb-7">
                <div>
                    <h2 class="fw-bold text-gray-900 fs-2 mb-1">Ringkasan Pemesanan</h2>
                    <span class="text-gray-500 fw-semibold fs-6">Status order dan sisa kuota per jenis tiket</span>
                </div>
                <span class="badge badge-light-primary fs-7 fw-bold px-4 py-3">
                    {{ count($summary) }} Jenis Tiket
                </span>
            </div>

            {{-- ===== Cards Per Tiket ===== --}}
            @forelse($summary as $item)
                @php
                    $totalSold = $item['paid'] + $item['pending'] + $item['expired'];
                    $totalKuota = $totalSold + $item['sisa_kuota'];
                    $pctPaid = $totalKuota > 0 ? round(($item['paid'] / $totalKuota) * 100) : 0;
                    $pctPending = $totalKuota > 0 ? round(($item['pending'] / $totalKuota) * 100) : 0;
                    $pctExpired = $totalKuota > 0 ? round(($item['expired'] / $totalKuota) * 100) : 0;
                    $pctSisa = 100 - $pctPaid - $pctPending - $pctExpired;
                @endphp

                <div class="card card-flush mb-7">
                    <!--begin::Card header-->
                    <div class="card-header pt-7">
                        <div class="card-title">
                            <div class="d-flex align-items-center gap-4">
                                <div class="symbol symbol-50px">
                                    <div class="symbol-label bg-light-primary">
                                        <i class="ki-outline ki-ticket fs-1 text-primary"></i>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="text-gray-900 fw-bold fs-4">{{ $item['ticket_name'] }}</span>
                                    <span class="text-muted fw-semibold fs-7 mt-1">
                                        <span class="badge badge-light fw-semibold me-1">ID #{{ $item['ticket_id'] }}</span>
                                        Total {{ number_format($totalKuota) }} tiket tersedia
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body pt-5 pb-7">

                        <!--begin::Stats row-->
                        <div class="row g-5 mb-7">

                            {{-- Sisa Kuota --}}
                            <div class="col-sm-6 col-xl-3">
                                <div class="border border-dashed border-primary rounded min-w-125px py-3 px-4">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="ki-outline ki-abstract-26 fs-3 text-primary me-2"></i>
                                        <span class="fs-2 fw-bold text-primary">
                                            {{ number_format($item['sisa_kuota']) }}
                                        </span>
                                    </div>
                                    <div class="fw-semibold fs-6 text-gray-500">Sisa Kuota</div>
                                </div>
                            </div>

                            {{-- Paid --}}
                            <div class="col-sm-6 col-xl-3">
                                <div class="border border-dashed border-success rounded min-w-125px py-3 px-4">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="ki-outline ki-check-circle fs-3 text-success me-2"></i>
                                        <span class="fs-2 fw-bold text-success">
                                            {{ number_format($item['paid']) }}
                                        </span>
                                    </div>
                                    <div class="fw-semibold fs-6 text-gray-500">Paid</div>
                                </div>
                            </div>

                            {{-- Pending --}}
                            <div class="col-sm-6 col-xl-3">
                                <div class="border border-dashed border-warning rounded min-w-125px py-3 px-4">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="ki-outline ki-time fs-3 text-warning me-2"></i>
                                        <span class="fs-2 fw-bold text-warning">
                                            {{ number_format($item['pending']) }}
                                        </span>
                                    </div>
                                    <div class="fw-semibold fs-6 text-gray-500">Pending</div>
                                </div>
                            </div>

                            {{-- Expired --}}
                            <div class="col-sm-6 col-xl-3">
                                <div class="border border-dashed border-danger rounded min-w-125px py-3 px-4">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="ki-outline ki-cross-circle fs-3 text-danger me-2"></i>
                                        <span class="fs-2 fw-bold text-danger">
                                            {{ number_format($item['expired']) }}
                                        </span>
                                    </div>
                                    <div class="fw-semibold fs-6 text-gray-500">Expired</div>
                                </div>
                            </div>

                        </div>
                        <!--end::Stats row-->

                        <div class="separator separator-dashed mb-6"></div>

                        <!--begin::Progress-->
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-gray-700 fw-bold fs-7">Distribusi Kuota</span>
                            <span class="text-muted fw-semibold fs-7">Total: {{ number_format($totalKuota) }} tiket</span>
                        </div>

                        <div class="d-flex rounded overflow-hidden mb-4" style="height: 8px; background: #f1f1f4;">
                            @if ($pctPaid > 0)
                                <div class="bg-success" style="width: {{ $pctPaid }}%" data-bs-toggle="tooltip"
                                    title="Paid: {{ $pctPaid }}%"></div>
                            @endif
                            @if ($pctPending > 0)
                                <div class="bg-warning" style="width: {{ $pctPending }}%" data-bs-toggle="tooltip"
                                    title="Pending: {{ $pctPending }}%"></div>
                            @endif
                            @if ($pctExpired > 0)
                                <div class="bg-danger" style="width: {{ $pctExpired }}%" data-bs-toggle="tooltip"
                                    title="Expired: {{ $pctExpired }}%"></div>
                            @endif
                            @if ($pctSisa > 0)
                                <div style="width: {{ $pctSisa }}%; background: #e9edf1;" data-bs-toggle="tooltip"
                                    title="Sisa: {{ $pctSisa }}%"></div>
                            @endif
                        </div>

                        <div class="d-flex flex-wrap gap-5">
                            <div class="d-flex align-items-center">
                                <span class="bullet bullet-dot bg-success me-2 h-8px w-8px"></span>
                                <span class="text-muted fw-semibold fs-7">Paid
                                    <span class="text-gray-800 fw-bold ms-1">{{ $pctPaid }}%</span>
                                </span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="bullet bullet-dot bg-warning me-2 h-8px w-8px"></span>
                                <span class="text-muted fw-semibold fs-7">Pending
                                    <span class="text-gray-800 fw-bold ms-1">{{ $pctPending }}%</span>
                                </span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="bullet bullet-dot bg-danger me-2 h-8px w-8px"></span>
                                <span class="text-muted fw-semibold fs-7">Expired
                                    <span class="text-gray-800 fw-bold ms-1">{{ $pctExpired }}%</span>
                                </span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="bullet bullet-dot bg-secondary me-2 h-8px w-8px"></span>
                                <span class="text-muted fw-semibold fs-7">Sisa
                                    <span class="text-gray-800 fw-bold ms-1">{{ $pctSisa }}%</span>
                                </span>
                            </div>
                        </div>
                        <!--end::Progress-->

                    </div>
                    <!--end::Card body-->
                </div>

            @empty
                <div class="card card-flush">
                    <div class="card-body text-center py-20">
                        <i class="ki-outline ki-ticket fs-5x text-gray-200 mb-5 d-block"></i>
                        <h3 class="text-gray-600 fw-bold fs-3 mb-2">Belum ada data tiket</h3>
                        <span class="text-gray-400 fw-semibold fs-6 d-block mb-7">
                            Data ringkasan akan muncul setelah tiket dibuat dan ada order masuk.
                        </span>
                        <a href="{{ route('superadmin.ticket') }}" class="btn btn-primary">
                            <i class="ki-outline ki-plus fs-2 me-1"></i>Buat Tiket Sekarang
                        </a>
                    </div>
                </div>
            @endforelse

        </div>
    </div>
    <!--end::Content-->
@endsection

@push('scripts')
    <script>
        var tooltipEls = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipEls.forEach(function(el) {
            new bootstrap.Tooltip(el);
        });
    </script>
@endpush

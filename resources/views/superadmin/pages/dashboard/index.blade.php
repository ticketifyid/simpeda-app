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

            {{-- Alert error jika gagal load --}}
            @if (isset($error))
                <div class="alert alert-danger d-flex align-items-center mb-6">
                    <i class="ki-outline ki-shield-cross fs-2hx text-danger me-4"></i>
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-danger">Gagal memuat data</h4>
                        <span>{{ $error }}</span>
                    </div>
                </div>
            @endif

            {{-- ===== SECTION: Ringkasan Per Tiket ===== --}}
            <div class="mb-6">
                <h2 class="fw-bold text-gray-800 fs-4 mb-1">Ringkasan Pemesanan</h2>
                <span class="text-gray-500 fs-6">Status order dan sisa kuota per jenis tiket</span>
            </div>

            @forelse($summary as $item)
                <div class="card mb-5 shadow-sm border-0">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6 pb-0">
                        <div class="d-flex align-items-center gap-3">
                            <div class="symbol symbol-45px">
                                <span class="symbol-label bg-light-primary">
                                    <i class="ki-outline ki-ticket fs-2 text-primary"></i>
                                </span>
                            </div>
                            <div>
                                <h3 class="card-title fw-bold text-gray-900 mb-0 fs-5">
                                    {{ $item['ticket_name'] }}
                                </h3>
                                <span class="text-gray-500 fs-7">ID Tiket: #{{ $item['ticket_id'] }}</span>
                            </div>
                        </div>
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body pt-4">
                        <div class="row g-4">

                            {{-- Sisa Kuota --}}
                            <div class="col-6 col-md-3">
                                <div class="bg-light-primary rounded-3 p-4 text-center h-100">
                                    <div class="d-flex justify-content-center mb-2">
                                        <span class="badge badge-circle badge-primary p-3">
                                            <i class="ki-outline ki-abstract-26 fs-3 text-white"></i>
                                        </span>
                                    </div>
                                    <div class="fs-2hx fw-bolder text-primary lh-1 mb-1">
                                        {{ number_format($item['sisa_kuota']) }}
                                    </div>
                                    <div class="text-gray-600 fw-semibold fs-7">Sisa Kuota</div>
                                </div>
                            </div>

                            {{-- Paid --}}
                            <div class="col-6 col-md-3">
                                <div class="bg-light-success rounded-3 p-4 text-center h-100">
                                    <div class="d-flex justify-content-center mb-2">
                                        <span class="badge badge-circle badge-success p-3">
                                            <i class="ki-outline ki-check-circle fs-3 text-white"></i>
                                        </span>
                                    </div>
                                    <div class="fs-2hx fw-bolder text-success lh-1 mb-1">
                                        {{ number_format($item['paid']) }}
                                    </div>
                                    <div class="text-gray-600 fw-semibold fs-7">Paid</div>
                                </div>
                            </div>

                            {{-- Pending --}}
                            <div class="col-6 col-md-3">
                                <div class="bg-light-warning rounded-3 p-4 text-center h-100">
                                    <div class="d-flex justify-content-center mb-2">
                                        <span class="badge badge-circle badge-warning p-3">
                                            <i class="ki-outline ki-time fs-3 text-white"></i>
                                        </span>
                                    </div>
                                    <div class="fs-2hx fw-bolder text-warning lh-1 mb-1">
                                        {{ number_format($item['pending']) }}
                                    </div>
                                    <div class="text-gray-600 fw-semibold fs-7">Pending</div>
                                </div>
                            </div>

                            {{-- Expired --}}
                            <div class="col-6 col-md-3">
                                <div class="bg-light-danger rounded-3 p-4 text-center h-100">
                                    <div class="d-flex justify-content-center mb-2">
                                        <span class="badge badge-circle badge-danger p-3">
                                            <i class="ki-outline ki-cross-circle fs-3 text-white"></i>
                                        </span>
                                    </div>
                                    <div class="fs-2hx fw-bolder text-danger lh-1 mb-1">
                                        {{ number_format($item['expired']) }}
                                    </div>
                                    <div class="text-gray-600 fw-semibold fs-7">Expired</div>
                                </div>
                            </div>

                        </div>

                        {{-- Progress bar sisa kuota --}}
                        @php
                            $totalSold = $item['paid'] + $item['pending'] + $item['expired'];
                            $totalKuota = $totalSold + $item['sisa_kuota'];
                            $pctPaid = $totalKuota > 0 ? round(($item['paid'] / $totalKuota) * 100) : 0;
                            $pctPending = $totalKuota > 0 ? round(($item['pending'] / $totalKuota) * 100) : 0;
                            $pctExpired = $totalKuota > 0 ? round(($item['expired'] / $totalKuota) * 100) : 0;
                            $pctSisa = 100 - $pctPaid - $pctPending - $pctExpired;
                        @endphp

                        <div class="mt-5">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-semibold text-gray-700 fs-7">Distribusi Kuota</span>
                                <span class="fw-semibold text-gray-500 fs-7">Total: {{ number_format($totalKuota) }}
                                    tiket</span>
                            </div>
                            <div class="h-10px rounded overflow-hidden d-flex">
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
                                    <div class="bg-light border" style="width: {{ $pctSisa }}%"
                                        data-bs-toggle="tooltip" title="Sisa: {{ $pctSisa }}%"></div>
                                @endif
                            </div>
                            {{-- Legend --}}
                            <div class="d-flex gap-4 mt-3 flex-wrap">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="bullet bullet-dot bg-success h-8px w-8px"></span>
                                    <span class="text-gray-600 fs-7">Paid ({{ $pctPaid }}%)</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="bullet bullet-dot bg-warning h-8px w-8px"></span>
                                    <span class="text-gray-600 fs-7">Pending ({{ $pctPending }}%)</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="bullet bullet-dot bg-danger h-8px w-8px"></span>
                                    <span class="text-gray-600 fs-7">Expired ({{ $pctExpired }}%)</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="bullet bullet-dot bg-secondary h-8px w-8px"></span>
                                    <span class="text-gray-600 fs-7">Sisa ({{ $pctSisa }}%)</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--end::Card body-->
                </div>
            @empty
                <div class="card">
                    <div class="card-body text-center py-20">
                        <i class="ki-outline ki-ticket fs-5x text-gray-300 mb-5 d-block"></i>
                        <h3 class="text-gray-600 fw-semibold">Belum ada data tiket</h3>
                        <p class="text-gray-400 fs-6">Data ringkasan akan muncul setelah tiket dibuat.</p>
                        <a href="{{ route('superadmin.ticket') }}" class="btn btn-primary mt-2">
                            <i class="ki-outline ki-plus me-2"></i>Buat Tiket
                        </a>
                    </div>
                </div>
            @endforelse

        </div>
    </div>
    <!--end::Content-->

    @push('scripts')
        <script>
            // Aktifkan semua tooltip Bootstrap
            var tooltipEls = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipEls.forEach(function(el) {
                new bootstrap.Tooltip(el);
            });
        </script>
    @endpush
@endsection

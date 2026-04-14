@extends('admin.layouts.app')

@push('styles')
    <style>
        @keyframes slideDown {
            from { transform: translateY(-20px); opacity: 0; }
            to   { transform: translateY(0);     opacity: 1; }
        }
        .alert { animation: slideDown 0.3s ease; }
    </style>
@endpush

@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar pt-5 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack flex-wrap">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        Riwayat Check-in Saya</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.checkin') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.checkin') }}" class="text-muted text-hover-primary">Check-in</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Riwayat Saya</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('admin.checkin') }}" class="btn btn-primary btn-sm">
                        <i class="ki-outline ki-check-circle fs-4 me-1"></i>
                        Check-in Peserta
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">

            @php
                $totalOrders = count($checkins);
                $totalQty    = collect($checkins)->sum(fn($log) => $log['order']['qty'] ?? 0);
            @endphp

            <!--begin::Summary Cards-->
            <div class="row g-5 mb-6">
                <div class="col-sm-6">
                    <div class="card card-flush">
                        <div class="card-body d-flex align-items-center gap-4 py-6">
                            <div class="symbol symbol-50px symbol-circle">
                                <span class="symbol-label bg-light-primary">
                                    <i class="ki-outline ki-check-circle fs-2 text-primary"></i>
                                </span>
                            </div>
                            <div>
                                <div class="text-gray-500 fw-semibold fs-7">Total Peserta Check-in</div>
                                <div class="text-gray-900 fw-bold fs-2">{{ $totalOrders }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card card-flush">
                        <div class="card-body d-flex align-items-center gap-4 py-6">
                            <div class="symbol symbol-50px symbol-circle">
                                <span class="symbol-label bg-light-success">
                                    <i class="ki-outline ki-tag fs-2 text-success"></i>
                                </span>
                            </div>
                            <div>
                                <div class="text-gray-500 fw-semibold fs-7">Total Tiket</div>
                                <div class="text-gray-900 fw-bold fs-2">{{ $totalQty }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Summary Cards-->

            <!--begin::Card-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                            <input type="text" id="searchCheckin" class="form-control form-control-solid w-250px ps-12"
                                placeholder="Cari No. Bill / Nama" />
                        </div>
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end">
                        <span class="text-muted fw-semibold fs-7">
                            {{ $totalOrders }} peserta &bull; {{ $totalQty }} tiket
                        </span>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="checkinTable">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-150px">No. Bill</th>
                                <th class="min-w-200px">Peserta</th>
                                <th class="min-w-150px">Tiket</th>
                                <th class="text-center min-w-80px">Qty</th>
                                <th class="min-w-150px">Waktu Check-in</th>
                                <th class="min-w-200px">Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @forelse ($checkins as $log)
                                <tr data-search="{{ strtolower(($log['order']['no_bill'] ?? '') . ' ' . ($log['order']['nama'] ?? '')) }}">
                                    <td>
                                        <span class="text-gray-800 fw-bold">{{ $log['order']['no_bill'] ?? '-' }}</span>
                                    </td>
                                    <td>
                                        <div class="text-gray-800 fw-bold">{{ $log['order']['nama'] ?? '-' }}</div>
                                        @if (!empty($log['order']['status']))
                                            <div class="mt-1">
                                                <span class="badge badge-light-success">{{ $log['order']['status'] }}</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $log['order']['ticket']['name'] ?? '-' }}
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold">{{ $log['order']['qty'] ?? '-' }}</span>
                                    </td>
                                    <td>
                                        @if (!empty($log['checked_in_at']))
                                            <div class="text-gray-800 fw-semibold">
                                                {{ \Carbon\Carbon::parse($log['checked_in_at'])->timezone('Asia/Jakarta')->format('d/m/Y') }}
                                            </div>
                                            <div class="text-muted fs-7">
                                                {{ \Carbon\Carbon::parse($log['checked_in_at'])->timezone('Asia/Jakarta')->format('H:i') }}
                                            </div>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($log['note']))
                                            <span class="text-gray-700">{{ $log['note'] }}</span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-15">
                                        <i class="ki-outline ki-time fs-5x text-gray-300 d-block mb-4"></i>
                                        <div class="text-gray-500 fw-semibold">Belum ada riwayat check-in</div>
                                        <div class="text-muted fs-7 mt-2">Check-in yang kamu lakukan akan muncul di sini</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->

        </div>
    </div>
    <!--end::Content-->
@endsection

@push('scripts')
    <script>
        document.getElementById('searchCheckin').addEventListener('keyup', function () {
            const search = this.value.toLowerCase();
            document.querySelectorAll('#checkinTable tbody tr[data-search]').forEach(row => {
                row.style.display = row.getAttribute('data-search').includes(search) ? '' : 'none';
            });
        });
    </script>
@endpush

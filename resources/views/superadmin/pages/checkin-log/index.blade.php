@extends('superadmin.layouts.app')

@push('styles')
    <style>
        @keyframes slideDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .alert {
            animation: slideDown 0.3s ease;
        }
    </style>
@endpush

@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar pt-5 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack flex-wrap">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        Check-in Logs</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('superadmin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Check-in Logs</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">

            @if (session('error'))
                <div class="alert alert-danger d-flex align-items-center p-5 mb-6">
                    <i class="ki-outline ki-information-5 fs-2hx text-danger me-4"></i>
                    <div class="d-flex flex-column">
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!--begin::Summary Cards-->
            <div class="row g-5 mb-6">
                <div class="col-sm-4">
                    <div class="card card-flush">
                        <div class="card-body d-flex align-items-center gap-4 py-6">
                            <div class="symbol symbol-50px symbol-circle">
                                <span class="symbol-label bg-light-primary">
                                    <i class="ki-outline ki-people fs-2 text-primary"></i>
                                </span>
                            </div>
                            <div>
                                <div class="text-gray-500 fw-semibold fs-7">Total Paid</div>
                                <div class="text-gray-900 fw-bold fs-2">{{ $summary['total_paid_orders'] }} <span
                                        class="fs-6 fw-semibold text-muted">order</span></div>
                                <div class="text-gray-500 fw-semibold fs-7">{{ $summary['total_paid_tickets'] }} tiket</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card card-flush">
                        <div class="card-body d-flex align-items-center gap-4 py-6">
                            <div class="symbol symbol-50px symbol-circle">
                                <span class="symbol-label bg-light-success">
                                    <i class="ki-outline ki-check-circle fs-2 text-success"></i>
                                </span>
                            </div>
                            <div>
                                <div class="text-gray-500 fw-semibold fs-7">Sudah Check-in</div>
                                <div class="text-gray-900 fw-bold fs-2">{{ $summary['total_checked_in_orders'] }} <span
                                        class="fs-6 fw-semibold text-muted">order</span></div>
                                <div class="text-gray-500 fw-semibold fs-7">{{ $summary['total_checked_in_tickets'] }} tiket
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card card-flush">
                        <div class="card-body d-flex align-items-center gap-4 py-6">
                            <div class="symbol symbol-50px symbol-circle">
                                <span class="symbol-label bg-light-warning">
                                    <i class="ki-outline ki-time fs-2 text-warning"></i>
                                </span>
                            </div>
                            <div>
                                <div class="text-gray-500 fw-semibold fs-7">Belum Check-in</div>
                                <div class="text-gray-900 fw-bold fs-2">{{ $summary['total_remaining_orders'] }} <span
                                        class="fs-6 fw-semibold text-muted">order</span></div>
                                <div class="text-gray-500 fw-semibold fs-7">{{ $summary['total_remaining_tickets'] }} tiket
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Summary Cards-->

            <!--begin::Per-Ticket Breakdown-->
            @if (!empty($byTicket))
                <div class="row g-5 mb-6">
                    @foreach ($byTicket as $t)
                        <div class="col-sm-4">
                            <div class="card card-flush">
                                <div class="card-body py-6">
                                    <div class="text-gray-800 fw-bold fs-6 mb-4">
                                        <i class="ki-outline ki-ticket fs-4 text-primary me-2"></i>
                                        {{ $t['ticket_name'] }}
                                    </div>
                                    <div class="d-flex justify-content-between text-center">
                                        <div>
                                            <div class="text-success fw-bold fs-3">{{ $t['checked_in_orders'] }}</div>
                                            <div class="text-muted fs-8">{{ $t['checked_in_tickets'] }} tiket</div>
                                            <div class="text-muted fs-7">Sudah Check-in</div>
                                        </div>
                                        <div class="border-start border-gray-200 mx-3"></div>
                                        <div>
                                            <div class="text-warning fw-bold fs-3">{{ $t['remaining_orders'] }}</div>
                                            <div class="text-muted fs-8">{{ $t['remaining_tickets'] }} tiket</div>
                                            <div class="text-muted fs-7">Belum Check-in</div>
                                        </div>
                                        <div class="border-start border-gray-200 mx-3"></div>
                                        <div>
                                            <div class="text-gray-800 fw-bold fs-3">{{ $t['paid_orders'] }}</div>
                                            <div class="text-muted fs-8">{{ $t['paid_tickets'] }} tiket</div>
                                            <div class="text-muted fs-7">Total Paid</div>
                                        </div>
                                    </div>
                                    {{-- Progress bar --}}
                                    @php
                                        $pct =
                                            $t['paid_tickets'] > 0
                                                ? round(($t['checked_in_tickets'] / $t['paid_tickets']) * 100)
                                                : 0;
                                    @endphp
                                    <div class="mt-4">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="text-muted fs-8">Progress check-in</span>
                                            <span class="text-gray-700 fw-semibold fs-8">{{ $pct }}%</span>
                                        </div>
                                        <div class="progress h-6px">
                                            <div class="progress-bar bg-success" style="width: {{ $pct }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <!--end::Per-Ticket Breakdown-->

            <!--begin::Card-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                            <input type="text" id="searchLog" class="form-control form-control-solid w-250px ps-12"
                                placeholder="Cari No. Bill / Nama / Admin" />
                        </div>
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end">
                        <span class="text-muted fw-semibold fs-7">
                            {{ $summary['total_checked_in_orders'] }} sudah &bull;
                            {{ $summary['total_remaining_orders'] }} belum check-in
                        </span>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="logTable">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-150px">No. Bill</th>
                                <th class="min-w-200px">Peserta</th>
                                <th class="min-w-150px">Tiket</th>
                                <th class="text-center min-w-80px">Qty</th>
                                <th class="min-w-150px">Waktu Check-in</th>
                                <th class="min-w-150px">Oleh</th>
                                <th class="min-w-200px">Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @forelse ($logs as $log)
                                <tr
                                    data-search="{{ strtolower(($log['order']['no_bill'] ?? '') . ' ' . ($log['order']['nama'] ?? '') . ' ' . ($log['checked_in_by']['name'] ?? '')) }}">
                                    <td>
                                        <span class="text-gray-800 fw-bold">{{ $log['order']['no_bill'] ?? '-' }}</span>
                                    </td>
                                    <td>
                                        <div class="text-gray-800 fw-bold">{{ $log['order']['nama'] ?? '-' }}</div>
                                        <div class="mt-1">
                                            <span
                                                class="badge badge-light-success">{{ $log['order']['status'] ?? '-' }}</span>
                                        </div>
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
                                        <div class="text-gray-800 fw-semibold">{{ $log['checked_in_by']['name'] ?? '-' }}
                                        </div>
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
                                    <td colspan="7" class="text-center py-15">
                                        <i class="ki-outline ki-check-circle fs-5x text-gray-300 d-block mb-4"></i>
                                        <div class="text-gray-500 fw-semibold">Belum ada log check-in</div>
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
        document.getElementById('searchLog').addEventListener('keyup', function() {
            const search = this.value.toLowerCase();
            document.querySelectorAll('#logTable tbody tr[data-search]').forEach(row => {
                row.style.display = row.getAttribute('data-search').includes(search) ? '' : 'none';
            });
        });
    </script>
@endpush

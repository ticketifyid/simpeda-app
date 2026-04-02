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
                        Notification Logs</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('superadmin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Notification Logs</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!--begin::Card-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                            <input type="text" id="searchLog" class="form-control form-control-solid w-250px ps-12"
                                placeholder="Search No. Bill / Name" />
                        </div>
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <div class="w-100 mw-175px">
                            <select class="form-select form-select-solid" id="filterStatus">
                                <option value="all">All Status</option>
                                <option value="failed">Ada yang Failed</option>
                                <option value="sent">Semua Sent</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="logTable">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-150px">No. Bill</th>
                                <th class="min-w-200px">Customer</th>
                                <th class="text-center min-w-150px">Email</th>
                                <th class="text-center min-w-150px">WhatsApp</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @forelse($grouped as $row)
                                @php
                                    $order = $row['order'];
                                    $email = $row['email'];
                                    $whatsapp = $row['whatsapp'];
                                    $emailStatus = $email['status'] ?? null;
                                    $waStatus = $whatsapp['status'] ?? null;
                                    $rowFilter =
                                        $emailStatus === 'failed' || $waStatus === 'failed' ? 'failed' : 'sent';
                                @endphp
                                <tr data-filter="{{ $rowFilter }}"
                                    data-search="{{ strtolower($order['no_bill'] . ' ' . $order['nama']) }}">
                                    <td>
                                        <span class="text-gray-800 fw-bold">{{ $order['no_bill'] }}</span>
                                    </td>
                                    <td>
                                        <div class="text-gray-800 fw-bold">{{ $order['nama'] }}</div>
                                        <div class="text-gray-500 fs-7">{{ $order['no_hp'] }}</div>
                                        <div class="text-gray-500 fs-7">{{ $order['email'] }}</div>
                                    </td>

                                    {{-- Email Status --}}
                                    <td class="text-center">
                                        @if (!$email)
                                            <div class="badge badge-light-dark">Belum Ada Log</div>
                                        @elseif ($emailStatus === 'sent')
                                            <div class="badge badge-light-success">Sent</div>
                                        @else
                                            <div class="badge badge-light-danger">Failed</div>
                                            @if ($email['error'])
                                                <div class="text-muted fs-8 mt-1">{{ Str::limit($email['error'], 40) }}
                                                </div>
                                            @endif
                                        @endif
                                        @if ($email)
                                            <div class="text-muted fs-8 mt-1">{{ $email['attempts'] }}x attempt</div>
                                        @endif
                                    </td>

                                    {{-- WhatsApp Status --}}
                                    <td class="text-center">
                                        @if (!$whatsapp)
                                            <div class="badge badge-light-dark">Belum Ada Log</div>
                                        @elseif ($waStatus === 'sent')
                                            <div class="badge badge-light-success">Sent</div>
                                        @else
                                            <div class="badge badge-light-danger">Failed</div>
                                            @if ($whatsapp['error'])
                                                <div class="text-muted fs-8 mt-1">{{ Str::limit($whatsapp['error'], 40) }}
                                                </div>
                                            @endif
                                        @endif
                                        @if ($whatsapp)
                                            <div class="text-muted fs-8 mt-1">{{ $whatsapp['attempts'] }}x attempt</div>
                                        @endif
                                    </td>

                                    {{-- Actions --}}
                                    <td class="text-end">
                                        @if ($emailStatus === 'failed' || $waStatus === 'failed')
                                            <a href="#"
                                                class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                Retry
                                                <i class="ki-outline ki-down fs-5 ms-1"></i>
                                            </a>
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-175px py-4"
                                                data-kt-menu="true">
                                                @if ($emailStatus === 'failed')
                                                    <div class="menu-item px-3">
                                                        <form method="POST"
                                                            action="{{ route('superadmin.notification-log.retry', $email['id']) }}">
                                                            @csrf
                                                            <button type="submit"
                                                                class="menu-link px-3 w-100 text-start border-0 bg-transparent">
                                                                <i class="ki-outline ki-sms fs-6 me-2"></i>
                                                                Retry Email
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                                @if ($waStatus === 'failed')
                                                    <div class="menu-item px-3">
                                                        <form method="POST"
                                                            action="{{ route('superadmin.notification-log.retry', $whatsapp['id']) }}">
                                                            @csrf
                                                            <button type="submit"
                                                                class="menu-link px-3 w-100 text-start border-0 bg-transparent">
                                                                <i class="ki-outline ki-message-text-2 fs-6 me-2"></i>
                                                                Retry WhatsApp
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-muted fs-7">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-10">
                                        <div class="text-gray-500">Belum ada log notifikasi</div>
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
        function applyFilters() {
            const search = document.getElementById('searchLog').value.toLowerCase();
            const status = document.getElementById('filterStatus').value;
            const rows = document.querySelectorAll('#logTable tbody tr[data-filter]');

            rows.forEach(row => {
                const rowFilter = row.getAttribute('data-filter');
                const rowSearch = row.getAttribute('data-search') || '';

                const matchSearch = rowSearch.includes(search);
                const matchStatus = (status === 'all' || status === rowFilter);

                row.style.display = (matchSearch && matchStatus) ? '' : 'none';
            });
        }

        document.getElementById('searchLog').addEventListener('keyup', applyFilters);
        document.getElementById('filterStatus').addEventListener('change', applyFilters);

        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
@endpush

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
                        Orders</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('superadmin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Orders</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">

            {{-- Alert Success --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Alert Error --}}
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
                            <input type="text" id="searchOrder" class="form-control form-control-solid w-250px ps-12"
                                placeholder="Search Order / Name" />
                        </div>
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <div class="w-100 mw-150px">
                            <select class="form-select form-select-solid" id="filterStatus">
                                <option value="all">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="paid">Paid</option>
                                <option value="failed">Failed</option>
                                <option value="expired">Expired</option>
                            </select>
                        </div>
                        {{-- Export Button --}}
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalExport">
                            <i class="ki-outline ki-exit-down fs-2"></i>
                            Export Excel
                        </button>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="orderTable">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-120px">No. Bill</th>
                                <th class="min-w-200px">Customer</th>
                                <th class="min-w-150px">Ticket</th>
                                <th class="min-w-120px">Discount</th>
                                <th class="text-end min-w-70px">Qty</th>
                                <th class="text-end min-w-120px">Total</th>
                                <th class="text-end min-w-100px">Status</th>
                                <th class="text-end min-w-70px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @forelse($orders as $order)
                                <tr data-status="{{ $order['status'] }}">
                                    <td>
                                        <span class="text-gray-800 fw-bold">{{ $order['no_bill'] }}</span>
                                    </td>
                                    <td>
                                        <div class="text-gray-800 fw-bold">{{ $order['nama'] }}</div>
                                        <div class="text-gray-500 fs-7">{{ $order['no_hp'] }}</div>
                                        <div class="text-gray-500 fs-7">{{ $order['email'] }}</div>
                                    </td>
                                    <td>
                                        {{ $order['ticket']['name'] ?? '-' }}
                                    </td>
                                    <td>
                                        {{ $order['discount']['name'] ?? '-' }}
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">{{ $order['qty'] }}</span>
                                    </td>
                                    <td class="text-end pe-0">
                                        Rp {{ number_format($order['total'], 0, ',', '.') }}
                                    </td>
                                    <td class="text-end pe-0">
                                        @switch($order['status'])
                                            @case('paid')
                                                <div class="badge badge-light-success">Paid</div>
                                            @break

                                            @case('pending')
                                                <div class="badge badge-light-warning">Pending</div>
                                            @break

                                            @case('failed')
                                                <div class="badge badge-light-danger">Failed</div>
                                            @break

                                            @case('expired')
                                                <div class="badge badge-light-dark">Expired</div>
                                            @break
                                        @endswitch
                                    </td>
                                    <td class="text-end">
                                        <a href="#"
                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-outline ki-down fs-5 ms-1"></i>
                                        </a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                    data-bs-target="#modalUpdateStatus"
                                                    onclick='openUpdateStatus(@json($order))'>
                                                    Update Status
                                                </a>
                                            </div>
                                            @if (in_array($order['status'], ['failed', 'expired']))
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3 text-danger"
                                                        data-bs-toggle="modal" data-bs-target="#modalDelete"
                                                        onclick="openDelete({{ $order['id'] }}, '{{ $order['no_bill'] }}')">
                                                        Delete
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-10">
                                            <div class="text-gray-500">No orders found</div>
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

        {{-- Modal Update Status --}}
        <div class="modal fade" id="modalUpdateStatus" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="formUpdateStatus" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Update Status Order</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <span class="text-gray-600 fs-7">No. Bill: </span>
                                <strong id="statusNoBill"></strong>
                            </div>
                            <div class="mb-5">
                                <label class="form-label required">Status</label>
                                <select name="status" id="statusSelect" class="form-select" required>
                                    <option value="pending">Pending</option>
                                    <option value="paid">Paid</option>
                                    <option value="failed">Failed</option>
                                    <option value="expired">Expired</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal Delete --}}
        <div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="formDelete" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Order</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete order <strong id="deleteNoBill"></strong>?</p>
                            <p class="text-muted">This action cannot be undone.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal Export --}}
        <div class="modal fade" id="modalExport" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form method="GET" action="{{ route('superadmin.order.export') }}">
                        <div class="modal-header">
                            <h5 class="modal-title">Export Orders</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">
                                    Status
                                    <span class="text-muted fs-7">(opsional, kosongkan untuk semua)</span>
                                </label>
                                <select name="status" class="form-select">
                                    <option value="">Semua Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="paid">Paid</option>
                                    <option value="failed">Failed</option>
                                    <option value="expired">Expired</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">
                                <i class="ki-outline ki-exit-down fs-2"></i>
                                Download Excel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            // Open Update Status Modal
            function openUpdateStatus(order) {
                document.getElementById('formUpdateStatus').action =
                    "{{ route('superadmin.order.updateStatus', ':id') }}".replace(':id', order.id);
                document.getElementById('statusNoBill').textContent = order.no_bill;
                document.getElementById('statusSelect').value = order.status;
            }

            // Open Delete Modal
            function openDelete(id, noBill) {
                document.getElementById('formDelete').action =
                    "{{ route('superadmin.order.destroy', ':id') }}".replace(':id', id);
                document.getElementById('deleteNoBill').textContent = noBill;
            }

            // Search + Status Filter
            function applyFilters() {
                const search = document.getElementById('searchOrder').value.toLowerCase();
                const status = document.getElementById('filterStatus').value;
                const rows = document.querySelectorAll('#orderTable tbody tr[data-status]');

                rows.forEach(row => {
                    const rowStatus = row.getAttribute('data-status');
                    const cells = row.querySelectorAll('td');
                    const noBill = cells[0]?.textContent.toLowerCase() || '';
                    const nama = cells[1]?.textContent.toLowerCase() || '';

                    const matchSearch = noBill.includes(search) || nama.includes(search);
                    const matchStatus = (status === 'all' || status === rowStatus);

                    row.style.display = (matchSearch && matchStatus) ? '' : 'none';
                });
            }

            document.getElementById('searchOrder').addEventListener('keyup', applyFilters);
            document.getElementById('filterStatus').addEventListener('change', applyFilters);

            // Auto dismiss alert after 5 seconds
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        </script>
    @endpush

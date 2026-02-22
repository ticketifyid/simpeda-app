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
                        Discounts</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('superadmin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Discounts</li>
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

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $errors->first() }}
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
                            <input type="text" id="searchDiscount" class="form-control form-control-solid w-250px ps-12"
                                placeholder="Search Discount" />
                        </div>
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <div class="w-100 mw-150px">
                            <select class="form-select form-select-solid" id="filterStatus">
                                <option value="all">All</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="w-100 mw-150px">
                            <select class="form-select form-select-solid" id="filterType">
                                <option value="all">All Types</option>
                                <option value="percentage">Percentage</option>
                                <option value="fixed">Fixed</option>
                            </select>
                        </div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
                            Add Discount
                        </button>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="discountTable">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-200px">Discount Name</th>
                                <th class="min-w-150px">Ticket</th>
                                <th class="text-end min-w-100px">Type</th>
                                <th class="text-end min-w-70px">Qty</th>
                                <th class="text-end min-w-100px">Value</th>
                                <th class="text-end min-w-100px">Status</th>
                                <th class="text-end min-w-70px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @forelse($discounts as $discount)
                                <tr data-status="{{ $discount['status'] }}" data-type="{{ $discount['type'] }}">
                                    <td>
                                        <div class="text-gray-800 text-hover-primary fs-5 fw-bold">
                                            {{ $discount['name'] }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-gray-600">
                                            {{ $discount['ticket']['name'] ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-0">
                                        @if ($discount['type'] === 'percentage')
                                            <div class="badge badge-light-info">Percentage</div>
                                        @else
                                            <div class="badge badge-light-warning">Fixed</div>
                                        @endif
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">{{ $discount['qty'] }}</span>
                                    </td>
                                    <td class="text-end pe-0">
                                        @if ($discount['type'] === 'percentage')
                                            {{ $discount['price'] }}%
                                        @else
                                            Rp {{ number_format($discount['price'], 0, ',', '.') }}
                                        @endif
                                    </td>
                                    <td class="text-end pe-0">
                                        @if ($discount['status'] === 'active')
                                            <div class="badge badge-light-success">Active</div>
                                        @else
                                            <div class="badge badge-light-danger">Inactive</div>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="#"
                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-outline ki-down fs-5 ms-1"></i>
                                        </a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                    data-bs-target="#modalEdit"
                                                    onclick='editDiscount(@json($discount))'>
                                                    Edit
                                                </a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3 text-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modalDelete"
                                                    onclick="deleteDiscount({{ $discount['id'] }}, '{{ $discount['name'] }}')">
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-10">
                                        <div class="text-gray-500">No discounts found</div>
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

    {{-- Modal Create --}}
    <div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('superadmin.discount.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Discount</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-5">
                            <label class="form-label required">Ticket</label>
                            <select name="ticket_id" class="form-select" required>
                                <option value="">Select Ticket</option>
                                @foreach ($tickets as $ticket)
                                    <option value="{{ $ticket['id'] }}">{{ $ticket['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-5">
                            <label class="form-label required">Discount Name</label>
                            <input type="text" name="name" class="form-control" required />
                        </div>
                        <div class="mb-5">
                            <label class="form-label required">Type</label>
                            <select name="type" class="form-select" id="createType" required
                                onchange="toggleCreatePriceLabel(this.value)">
                                <option value="percentage">Percentage</option>
                                <option value="fixed">Fixed</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <label class="form-label required" id="createPriceLabel">Value (%)</label>
                            <input type="number" name="price" class="form-control" min="0" step="0.01"
                                required />
                        </div>
                        <div class="mb-5">
                            <label class="form-label required">Quantity</label>
                            <input type="number" name="qty" class="form-control" min="1" required />
                        </div>
                        <div class="mb-5">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="formEdit" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Discount</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-5">
                            <label class="form-label required">Ticket</label>
                            <select name="ticket_id" id="editTicketId" class="form-select" required>
                                <option value="">Select Ticket</option>
                                @foreach ($tickets as $ticket)
                                    <option value="{{ $ticket['id'] }}">{{ $ticket['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-5">
                            <label class="form-label required">Discount Name</label>
                            <input type="text" name="name" id="editName" class="form-control" required />
                        </div>
                        <div class="mb-5">
                            <label class="form-label required">Type</label>
                            <select name="type" id="editType" class="form-select" required
                                onchange="toggleEditPriceLabel(this.value)">
                                <option value="percentage">Percentage</option>
                                <option value="fixed">Fixed</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <label class="form-label required" id="editPriceLabel">Value (%)</label>
                            <input type="number" name="price" id="editPrice" class="form-control" min="0"
                                step="0.01" required />
                        </div>
                        <div class="mb-5">
                            <label class="form-label required">Quantity</label>
                            <input type="number" name="qty" id="editQty" class="form-control" min="1"
                                required />
                        </div>
                        <div class="mb-5">
                            <label class="form-label">Status</label>
                            <select name="status" id="editStatus" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
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
                        <h5 class="modal-title">Delete Discount</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete <strong id="deleteDiscountName"></strong>?</p>
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
@endsection

@push('scripts')
    <script>
        // Toggle price label Create
        function toggleCreatePriceLabel(type) {
            document.getElementById('createPriceLabel').textContent = type === 'percentage' ? 'Value (%)' : 'Value (Rp)';
        }

        // Toggle price label Edit
        function toggleEditPriceLabel(type) {
            document.getElementById('editPriceLabel').textContent = type === 'percentage' ? 'Value (%)' : 'Value (Rp)';
        }

        // Edit Discount
        function editDiscount(discount) {
            document.getElementById('formEdit').action = "{{ route('superadmin.discount.update', ':id') }}".replace(':id',
                discount.id);
            document.getElementById('editTicketId').value = discount.ticket_id;
            document.getElementById('editName').value = discount.name;
            document.getElementById('editType').value = discount.type;
            document.getElementById('editPrice').value = discount.price;
            document.getElementById('editQty').value = discount.qty;
            document.getElementById('editStatus').value = discount.status;
            toggleEditPriceLabel(discount.type);
        }

        // Delete Discount
        function deleteDiscount(id, name) {
            document.getElementById('formDelete').action = "{{ route('superadmin.discount.destroy', ':id') }}".replace(
                ':id', id);
            document.getElementById('deleteDiscountName').textContent = name;
        }

        // Search Filter
        document.getElementById('searchDiscount').addEventListener('keyup', applyFilters);

        // Status Filter
        document.getElementById('filterStatus').addEventListener('change', applyFilters);

        // Type Filter
        document.getElementById('filterType').addEventListener('change', applyFilters);

        function applyFilters() {
            const search = document.getElementById('searchDiscount').value.toLowerCase();
            const status = document.getElementById('filterStatus').value;
            const type = document.getElementById('filterType').value;
            const rows = document.querySelectorAll('#discountTable tbody tr[data-status]');

            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                const rowType = row.getAttribute('data-type');
                const name = row.querySelectorAll('td')[0]?.textContent.toLowerCase() || '';

                const matchSearch = name.includes(search);
                const matchStatus = (status === 'all' || status === rowStatus);
                const matchType = (type === 'all' || type === rowType);

                row.style.display = (matchSearch && matchStatus && matchType) ? '' : 'none';
            });
        }

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

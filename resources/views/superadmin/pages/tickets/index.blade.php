@extends('superadmin.layouts.app')

@push('styles')
    <style>
        /* Auto-dismiss alert animation */
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
                        Tickets</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('superadmin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Tickets</li>
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
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $errors->first('error') }}
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
                            <input type="text" id="searchTicket" class="form-control form-control-solid w-250px ps-12"
                                placeholder="Search Ticket" />
                        </div>
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <div class="w-100 mw-150px">
                            <select class="form-select form-select-solid" id="filterStatus">
                                <option value="all">All</option>
                                <option value="published">Published</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
                            Add Ticket
                        </button>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="ticketTable">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-200px">Ticket Name</th>
                                <th class="text-end min-w-70px">Qty</th>
                                <th class="text-end min-w-100px">Price</th>
                                <th class="text-end min-w-100px">Status</th>
                                <th class="text-end min-w-70px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @forelse($tickets as $ticket)
                                <tr data-status="{{ $ticket['status'] }}">
                                    <td>
                                        <div class="text-gray-800 text-hover-primary fs-5 fw-bold">
                                            {{ $ticket['name'] }}
                                        </div>
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">{{ $ticket['qty'] }}</span>
                                    </td>
                                    <td class="text-end pe-0">
                                        Rp {{ number_format($ticket['price'], 0, ',', '.') }}
                                    </td>
                                    <td class="text-end pe-0">
                                        @if ($ticket['status'] === 'published')
                                            <div class="badge badge-light-success">Published</div>
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
                                                    onclick='editTicket(@json($ticket))'>
                                                    Edit
                                                </a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                    data-bs-target="#modalDelete"
                                                    onclick="deleteTicket({{ $ticket['id'] }}, '{{ $ticket['name'] }}')">
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-10">
                                        <div class="text-gray-500">No tickets found</div>
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
                <form action="{{ route('superadmin.ticket.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Ticket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-5">
                            <label class="form-label required">Ticket Name</label>
                            <input type="text" name="name" class="form-control" required />
                        </div>
                        <div class="mb-5">
                            <label class="form-label required">Quantity</label>
                            <input type="number" name="qty" class="form-control" min="1" required />
                        </div>
                        <div class="mb-5">
                            <label class="form-label required">Price</label>
                            <input type="number" name="price" class="form-control" min="0" step="0.01"
                                required />
                        </div>
                        <div class="mb-5">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="published">Published</option>
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
                        <h5 class="modal-title">Edit Ticket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-5">
                            <label class="form-label required">Ticket Name</label>
                            <input type="text" name="name" id="editName" class="form-control" required />
                        </div>
                        <div class="mb-5">
                            <label class="form-label required">Quantity</label>
                            <input type="number" name="qty" id="editQty" class="form-control" min="1"
                                required />
                        </div>
                        <div class="mb-5">
                            <label class="form-label required">Price</label>
                            <input type="number" name="price" id="editPrice" class="form-control" min="0"
                                step="0.01" required />
                        </div>
                        <div class="mb-5">
                            <label class="form-label">Status</label>
                            <select name="status" id="editStatus" class="form-select">
                                <option value="published">Published</option>
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
                        <h5 class="modal-title">Delete Ticket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete <strong id="deleteTicketName"></strong>?</p>
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
        // Edit Ticket
        function editTicket(ticket) {
            document.getElementById('formEdit').action = "{{ route('superadmin.ticket.update', ':id') }}".replace(':id',
                ticket.id);
            document.getElementById('editName').value = ticket.name;
            document.getElementById('editQty').value = ticket.qty;
            document.getElementById('editPrice').value = ticket.price;
            document.getElementById('editStatus').value = ticket.status;
        }

        // Delete Ticket
        function deleteTicket(id, name) {
            document.getElementById('formDelete').action = "{{ route('superadmin.ticket.destroy', ':id') }}".replace(':id',
                id);
            document.getElementById('deleteTicketName').textContent = name;
        }

        // Search Filter
        document.getElementById('searchTicket').addEventListener('keyup', function() {
            const search = this.value.toLowerCase();
            const rows = document.querySelectorAll('#ticketTable tbody tr[data-status]');

            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const name = cells[0]?.textContent.toLowerCase() || '';
                row.style.display = name.includes(search) ? '' : 'none';
            });
        });

        // Status Filter
        document.getElementById('filterStatus').addEventListener('change', function() {
            const status = this.value;
            const search = document.getElementById('searchTicket').value.toLowerCase();
            const rows = document.querySelectorAll('#ticketTable tbody tr[data-status]');

            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                const cells = row.querySelectorAll('td');
                const name = cells[0]?.textContent.toLowerCase() || '';

                const matchStatus = (status === 'all' || status === rowStatus);
                const matchSearch = name.includes(search);

                row.style.display = (matchStatus && matchSearch) ? '' : 'none';
            });
        });

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

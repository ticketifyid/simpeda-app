@extends('admin.layouts.app')

@push('styles')
    <style>
        @keyframes slideDown {
            from { transform: translateY(-20px); opacity: 0; }
            to   { transform: translateY(0);     opacity: 1; }
        }
        .alert, .result-card { animation: slideDown 0.3s ease; }
    </style>
@endpush

@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar pt-5 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack flex-wrap">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        Check-in Peserta</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.checkin') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Check-in</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('admin.checkin.my') }}" class="btn btn-light-primary btn-sm">
                        <i class="ki-outline ki-time fs-4 me-1"></i>
                        Riwayat Check-in Saya
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">

            <div class="row g-5 justify-content-center">
                <!--begin::Form Column-->
                <div class="col-xl-6">
                    <!--begin::Card-->
                    <div class="card card-flush">
                        <div class="card-header pt-6">
                            <div class="card-title flex-column">
                                <h3 class="fw-bold mb-1">Scan / Input No. Bill</h3>
                                <div class="text-muted fw-semibold fs-7">Masukkan nomor bill peserta untuk melakukan check-in</div>
                            </div>
                        </div>
                        <div class="card-body pt-5">
                            <form method="POST" action="{{ route('admin.checkin.store') }}" id="checkinForm">
                                @csrf

                                <!--begin::No. Bill-->
                                <div class="mb-5">
                                    <label class="form-label required fw-semibold">No. Bill</label>
                                    <input
                                        type="text"
                                        name="no_bill"
                                        id="no_bill"
                                        class="form-control form-control-solid @error('no_bill') is-invalid @enderror"
                                        placeholder="Contoh: 8870012345"
                                        value="{{ old('no_bill') }}"
                                        autofocus
                                        autocomplete="off"
                                    />
                                    @error('no_bill')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!--end::No. Bill-->

                                <!--begin::Note-->
                                <div class="mb-7">
                                    <label class="form-label fw-semibold">
                                        Catatan
                                        <span class="text-muted fs-7">(opsional, maks. 500 karakter)</span>
                                    </label>
                                    <textarea
                                        name="note"
                                        class="form-control form-control-solid @error('note') is-invalid @enderror"
                                        rows="3"
                                        placeholder="Contoh: Peserta datang terlambat"
                                        maxlength="500"
                                    >{{ old('note') }}</textarea>
                                    @error('note')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!--end::Note-->

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary w-100" id="submitBtn">
                                        <i class="ki-outline ki-check-circle fs-3 me-1"></i>
                                        Check-in Sekarang
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Form Column-->

                <!--begin::Result Column-->
                <div class="col-xl-6">

                    @if (session('checkin_success'))
                        @php $result = session('checkin_result'); @endphp
                        <!--begin::Success Result-->
                        <div class="card card-flush border border-success result-card">
                            <div class="card-header pt-6">
                                <div class="card-title">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="symbol symbol-40px symbol-circle">
                                            <span class="symbol-label bg-light-success">
                                                <i class="ki-outline ki-check-circle fs-2 text-success"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <h3 class="fw-bold text-success mb-0">Check-in Berhasil!</h3>
                                            <div class="text-muted fs-7">Peserta berhasil check-in</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-4">
                                <div class="d-flex flex-column gap-3">
                                    <div class="d-flex justify-content-between border-bottom pb-3">
                                        <span class="text-muted fw-semibold fs-7">No. Bill</span>
                                        <span class="text-gray-800 fw-bold">{{ $result['no_bill'] ?? '-' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between border-bottom pb-3">
                                        <span class="text-muted fw-semibold fs-7">Nama</span>
                                        <span class="text-gray-800 fw-bold">{{ $result['nama'] ?? '-' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between border-bottom pb-3">
                                        <span class="text-muted fw-semibold fs-7">Tiket</span>
                                        <span class="text-gray-800 fw-semibold">{{ $result['ticket']['name'] ?? '-' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between border-bottom pb-3">
                                        <span class="text-muted fw-semibold fs-7">Status Order</span>
                                        <span class="badge badge-light-success">{{ $result['status'] ?? '-' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between border-bottom pb-3">
                                        <span class="text-muted fw-semibold fs-7">Jumlah Tiket</span>
                                        <span class="text-gray-800 fw-bold">{{ $result['qty'] ?? '-' }}</span>
                                    </div>
                                    @if (!empty($result['check_in']))
                                        <div class="d-flex justify-content-between border-bottom pb-3">
                                            <span class="text-muted fw-semibold fs-7">Waktu Check-in</span>
                                            <span class="text-gray-800 fw-semibold">
                                                {{ \Carbon\Carbon::parse($result['check_in']['checked_in_at'])->timezone('Asia/Jakarta')->format('d/m/Y H:i') }}
                                            </span>
                                        </div>
                                        @if (!empty($result['check_in']['note']))
                                            <div class="d-flex justify-content-between">
                                                <span class="text-muted fw-semibold fs-7">Catatan</span>
                                                <span class="text-gray-800 fw-semibold">{{ $result['check_in']['note'] }}</span>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--end::Success Result-->

                    @elseif (session('checkin_error'))
                        <!--begin::Error Result-->
                        <div class="card card-flush border border-danger result-card">
                            <div class="card-header pt-6">
                                <div class="card-title">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="symbol symbol-40px symbol-circle">
                                            <span class="symbol-label bg-light-danger">
                                                <i class="ki-outline ki-cross-circle fs-2 text-danger"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <h3 class="fw-bold text-danger mb-0">Check-in Gagal</h3>
                                            <div class="text-muted fs-7">{{ session('checkin_error') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (session('checkin_result'))
                                @php $result = session('checkin_result'); @endphp
                                <div class="card-body pt-4">
                                    <div class="d-flex flex-column gap-3">
                                        <div class="d-flex justify-content-between border-bottom pb-3">
                                            <span class="text-muted fw-semibold fs-7">No. Bill</span>
                                            <span class="text-gray-800 fw-bold">{{ $result['no_bill'] ?? '-' }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between border-bottom pb-3">
                                            <span class="text-muted fw-semibold fs-7">Nama</span>
                                            <span class="text-gray-800 fw-bold">{{ $result['nama'] ?? '-' }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between border-bottom pb-3">
                                            <span class="text-muted fw-semibold fs-7">Tiket</span>
                                            <span class="text-gray-800 fw-semibold">{{ $result['ticket']['name'] ?? '-' }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between border-bottom pb-3">
                                            <span class="text-muted fw-semibold fs-7">Jumlah Tiket</span>
                                            <span class="text-gray-800 fw-bold">{{ $result['qty'] ?? '-' }}</span>
                                        </div>
                                        @if (!empty($result['check_in']))
                                            <div class="d-flex justify-content-between border-bottom pb-3">
                                                <span class="text-muted fw-semibold fs-7">Sudah Check-in</span>
                                                <span class="text-gray-800 fw-semibold">
                                                    {{ \Carbon\Carbon::parse($result['check_in']['checked_in_at'])->timezone('Asia/Jakarta')->format('d/m/Y H:i') }}
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span class="text-muted fw-semibold fs-7">Oleh</span>
                                                <span class="text-gray-800 fw-semibold">{{ $result['check_in']['checked_in_by']['name'] ?? '-' }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!--end::Error Result-->

                    @else
                        <!--begin::Empty State-->
                        <div class="card card-flush h-100">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center py-15">
                                <i class="ki-outline ki-scan-barcode fs-5x text-gray-300 mb-5"></i>
                                <div class="text-gray-500 fw-semibold fs-6">Hasil check-in akan muncul di sini</div>
                                <div class="text-muted fs-7 mt-2">Masukkan No. Bill lalu klik Check-in</div>
                            </div>
                        </div>
                        <!--end::Empty State-->
                    @endif

                </div>
                <!--end::Result Column-->
            </div>

        </div>
    </div>
    <!--end::Content-->
@endsection

@push('scripts')
    <script>
        // Cegah Enter di no_bill langsung submit — pindah focus ke note dulu
        document.getElementById('no_bill').addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.querySelector('textarea[name="note"]').focus();
            }
        });

        // Enter di note → submit form
        document.querySelector('textarea[name="note"]').addEventListener('keydown', function (e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                document.getElementById('checkinForm').requestSubmit();
            }
        });

        document.getElementById('checkinForm').addEventListener('submit', function () {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';
        });
    </script>
@endpush

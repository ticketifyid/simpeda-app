<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Tiket — Ticketify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #3D3594;
            --primary-dark: #2e2870;
            --accent: #F5A623;
            --accent-2: #E8762C;
            --light-bg: #F4F3FF;
        }

        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: var(--light-bg);
            color: #1a1a2e;
        }

        /* ─── Navbar ─── */
        .navbar {
            background: var(--primary);
            padding: 1rem 0;
            box-shadow: 0 2px 20px rgba(61, 53, 148, .3);
        }

        .navbar-brand span {
            color: var(--accent);
            font-weight: 800;
            font-size: 1.4rem;
            letter-spacing: 1px;
        }

        .navbar-back {
            color: rgba(255, 255, 255, .75);
            text-decoration: none;
            font-size: .9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: .4rem;
            transition: color .2s;
        }

        .navbar-back:hover {
            color: var(--accent);
        }

        /* ─── Page Header ─── */
        .page-header {
            background: linear-gradient(135deg, var(--primary) 0%, #5548c8 100%);
            padding: 3rem 0;
        }

        .page-header h1 {
            color: #fff;
            font-size: 1.8rem;
            font-weight: 800;
        }

        .page-header p {
            color: rgba(255, 255, 255, .7);
            font-size: .95rem;
            margin: 0;
        }

        /* ─── Ticket Summary Card ─── */
        .ticket-summary {
            background: #fff;
            border-radius: 20px;
            padding: 1.5rem 2rem;
            border-left: 5px solid var(--accent);
            box-shadow: 0 4px 24px rgba(61, 53, 148, .08);
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .ticket-summary-icon {
            width: 56px;
            height: 56px;
            background: var(--light-bg);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .ticket-summary-icon i {
            color: var(--primary);
            font-size: 1.5rem;
        }

        .ticket-summary-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a1a2e;
        }

        .ticket-summary-price {
            color: var(--primary);
            font-weight: 800;
            font-size: 1.2rem;
        }

        /* ─── Form Card ─── */
        .form-card {
            background: #fff;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 24px rgba(61, 53, 148, .08);
            margin-bottom: 1.5rem;
        }

        .form-card-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1.5rem;
            padding-bottom: .75rem;
            border-bottom: 2px solid var(--light-bg);
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .form-label {
            font-weight: 600;
            font-size: .875rem;
            color: #444;
            margin-bottom: .4rem;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 2px solid #e8e8f0;
            padding: .7rem 1rem;
            font-size: .95rem;
            transition: border-color .2s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(61, 53, 148, .1);
        }

        /* ─── Discount Section ─── */
        .discount-section {
            background: #fff;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 24px rgba(61, 53, 148, .08);
            margin-bottom: 1.5rem;
        }

        .discount-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
        }

        .discount-toggle-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .discount-toggle-badge {
            background: var(--light-bg);
            color: var(--primary);
            font-size: .75rem;
            font-weight: 600;
            padding: .2rem .6rem;
            border-radius: 50px;
        }

        .discount-body {
            margin-top: 1.5rem;
        }

        .discount-applied {
            background: #f0fdf4;
            border: 1px solid #86efac;
            border-radius: 12px;
            padding: 1rem 1.2rem;
            margin-top: 1rem;
            display: none;
        }

        .discount-applied.show {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .discount-applied-name {
            font-weight: 700;
            color: #16a34a;
        }

        .discount-applied-value {
            font-size: .85rem;
            color: #666;
        }

        .btn-remove-discount {
            background: none;
            border: none;
            color: #ef4444;
            font-size: .85rem;
            cursor: pointer;
            padding: 0;
        }

        /* ─── Order Summary Sticky ─── */
        .summary-card {
            background: #fff;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 24px rgba(61, 53, 148, .08);
            position: sticky;
            top: 80px;
        }

        .summary-title {
            font-size: 1rem;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 1.5rem;
            padding-bottom: .75rem;
            border-bottom: 2px solid var(--light-bg);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: .8rem;
            font-size: .9rem;
        }

        .summary-row .label {
            color: #888;
        }

        .summary-row .value {
            font-weight: 600;
            color: #1a1a2e;
        }

        .summary-row.discount .value {
            color: #16a34a;
        }

        .summary-divider {
            border-top: 2px dashed #e8e8f0;
            margin: 1rem 0;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .summary-total .label {
            font-weight: 700;
            font-size: 1rem;
        }

        .summary-total .value {
            font-weight: 800;
            font-size: 1.4rem;
            color: var(--primary);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary) 0%, #5548c8 100%);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: .85rem;
            font-weight: 700;
            font-size: 1rem;
            width: 100%;
            margin-top: 1.5rem;
            transition: all .3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(61, 53, 148, .3);
            color: #fff;
        }

        .btn-apply-discount {
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: .7rem 1.2rem;
            font-weight: 700;
            font-size: .9rem;
            white-space: nowrap;
            transition: all .2s;
        }

        .btn-apply-discount:hover {
            background: var(--accent-2);
            color: #fff;
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar">
        <div class="container d-flex align-items-center justify-content-between">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('landing') }}">
                <span>TICKETIFY</span>
            </a>
            <a href="{{ route('landing') }}" class="navbar-back">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </nav>

    {{-- Page Header --}}
    <div class="page-header">
        <div class="container">
            <h1><i class="bi bi-cart-check me-2"></i>Pesan Tiket</h1>
            <p>Lengkapi data di bawah untuk menyelesaikan pemesanan</p>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-4">

            {{-- LEFT: Form --}}
            <div class="col-lg-8">

                {{-- Ticket Summary --}}
                <div class="ticket-summary">
                    <div class="ticket-summary-icon">
                        <i class="bi bi-ticket-perforated"></i>
                    </div>
                    <div>
                        <div class="ticket-summary-name">{{ $ticket['name'] }}</div>
                        <div class="ticket-summary-price">
                            Rp {{ number_format($ticket['price'], 0, ',', '.') }}
                            <span style="font-size:.8rem; font-weight:400; color:#aaa;">/ tiket</span>
                        </div>
                    </div>
                </div>

                {{-- Form --}}
                <form action="{{ route('landing.order.store') }}" method="POST" id="orderForm">
                    @csrf
                    <input type="hidden" name="ticket_id" value="{{ $ticket['id'] }}">
                    <input type="hidden" name="discount_id" id="selectedDiscountId" value="">

                    {{-- Data Diri --}}
                    <div class="form-card">
                        <div class="form-card-title">
                            <i class="bi bi-person-fill"></i> Data Pemesan
                        </div>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control"
                                    placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">No. HP / WhatsApp <span class="text-danger">*</span></label>
                                <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx"
                                    value="{{ old('no_hp') }}" required>
                                @error('no_hp')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="email@example.com" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Jumlah Tiket <span class="text-danger">*</span></label>
                                <input type="number" name="qty" id="inputQty" class="form-control" min="1"
                                    max="{{ $ticket['qty'] }}" value="{{ old('qty', 1) }}" required>
                                <div class="form-text">Maks. {{ $ticket['qty'] }} tiket</div>
                                @error('qty')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Discount --}}
                    @if (count($discounts) > 0)
                        <div class="discount-section">
                            <div class="discount-toggle" onclick="toggleDiscount()">
                                <div class="discount-toggle-title">
                                    <i class="bi bi-tag-fill"></i> Punya Kode Diskon?
                                    <span class="discount-toggle-badge">Opsional</span>
                                </div>
                                <i class="bi bi-chevron-down" id="discountChevron"></i>
                            </div>

                            <div class="discount-body" id="discountBody" style="display:none;">
                                <label class="form-label">Pilih Diskon</label>
                                <div class="input-group">
                                    <select class="form-select" id="discountSelect">
                                        <option value="">-- Pilih diskon --</option>
                                        @foreach ($discounts as $discount)
                                            <option value="{{ $discount['id'] }}" data-type="{{ $discount['type'] }}"
                                                data-price="{{ $discount['price'] }}"
                                                data-name="{{ $discount['name'] }}">
                                                {{ $discount['name'] }}
                                                @if ($discount['type'] === 'percentage')
                                                    ({{ $discount['price'] }}% off)
                                                @else
                                                    (Rp {{ number_format($discount['price'], 0, ',', '.') }} off)
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn-apply-discount" onclick="applyDiscount()">
                                        Pakai
                                    </button>
                                </div>

                                <div class="discount-applied" id="discountApplied">
                                    <div>
                                        <div class="discount-applied-name" id="appliedDiscountName"></div>
                                        <div class="discount-applied-value" id="appliedDiscountValue"></div>
                                    </div>
                                    <button type="button" class="btn-remove-discount" onclick="removeDiscount()">
                                        <i class="bi bi-x-circle-fill"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif

                </form>
            </div>

            {{-- RIGHT: Summary --}}
            <div class="col-lg-4">
                <div class="summary-card">
                    <div class="summary-title">Ringkasan Pesanan</div>

                    <div class="summary-row">
                        <span class="label">Tiket</span>
                        <span class="value">{{ $ticket['name'] }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="label">Harga Satuan</span>
                        <span class="value" id="summaryPrice">
                            Rp {{ number_format($ticket['price'], 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="summary-row">
                        <span class="label">Jumlah</span>
                        <span class="value" id="summaryQty">1 tiket</span>
                    </div>

                    <div class="summary-divider"></div>

                    <div class="summary-row">
                        <span class="label">Subtotal</span>
                        <span class="value" id="summarySubtotal">
                            Rp {{ number_format($ticket['price'], 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="summary-row discount" id="summaryDiscountRow" style="display:none;">
                        <span class="label">Diskon</span>
                        <span class="value" id="summaryDiscount">- Rp 0</span>
                    </div>

                    <div class="summary-divider"></div>

                    <div class="summary-total">
                        <span class="label">Total</span>
                        <span class="value" id="summaryTotal">
                            Rp {{ number_format($ticket['price'], 0, ',', '.') }}
                        </span>
                    </div>

                    <button type="submit" form="orderForm" class="btn-submit">
                        <i class="bi bi-lock-fill"></i> Pesan Sekarang
                    </button>

                    <p class="text-center text-muted mt-3 mb-0" style="font-size:.8rem;">
                        <i class="bi bi-shield-check-fill text-success me-1"></i>
                        Transaksi aman & terenkripsi
                    </p>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const ticketPrice = {{ $ticket['price'] }};
        let discountAmount = 0;
        let appliedDiscount = null;

        // Format Rupiah
        function formatRp(n) {
            return 'Rp ' + Math.round(n).toLocaleString('id-ID');
        }

        // Update summary realtime
        function updateSummary() {
            const qty = parseInt(document.getElementById('inputQty').value) || 1;
            const subtotal = ticketPrice * qty;
            let total = subtotal;

            // Hitung diskon
            if (appliedDiscount) {
                if (appliedDiscount.type === 'percentage') {
                    discountAmount = subtotal * (appliedDiscount.price / 100);
                } else {
                    discountAmount = appliedDiscount.price;
                }
                total = Math.max(0, subtotal - discountAmount);
                document.getElementById('summaryDiscountRow').style.display = 'flex';
                document.getElementById('summaryDiscount').textContent = '- ' + formatRp(discountAmount);
            } else {
                discountAmount = 0;
                document.getElementById('summaryDiscountRow').style.display = 'none';
            }

            document.getElementById('summaryQty').textContent = qty + ' tiket';
            document.getElementById('summarySubtotal').textContent = formatRp(subtotal);
            document.getElementById('summaryTotal').textContent = formatRp(total);
        }

        document.getElementById('inputQty').addEventListener('input', updateSummary);

        // Toggle discount panel
        function toggleDiscount() {
            const body = document.getElementById('discountBody');
            const icon = document.getElementById('discountChevron');
            const open = body.style.display === 'none';
            body.style.display = open ? 'block' : 'none';
            icon.className = open ? 'bi bi-chevron-up' : 'bi bi-chevron-down';
        }

        // Apply discount
        function applyDiscount() {
            const select = document.getElementById('discountSelect');
            const option = select.options[select.selectedIndex];
            if (!select.value) return alert('Pilih diskon terlebih dahulu.');

            appliedDiscount = {
                id: select.value,
                type: option.dataset.type,
                price: parseFloat(option.dataset.price),
                name: option.dataset.name,
            };

            document.getElementById('selectedDiscountId').value = appliedDiscount.id;
            document.getElementById('appliedDiscountName').textContent = appliedDiscount.name;

            const label = appliedDiscount.type === 'percentage' ?
                appliedDiscount.price + '% potongan harga' :
                'Potongan Rp ' + parseFloat(appliedDiscount.price).toLocaleString('id-ID');
            document.getElementById('appliedDiscountValue').textContent = label;

            document.getElementById('discountApplied').classList.add('show');
            updateSummary();
        }

        // Remove discount
        function removeDiscount() {
            appliedDiscount = null;
            document.getElementById('selectedDiscountId').value = '';
            document.getElementById('discountApplied').classList.remove('show');
            document.getElementById('discountSelect').value = '';
            updateSummary();
        }

        // Init
        updateSummary();
    </script>
</body>

</html>

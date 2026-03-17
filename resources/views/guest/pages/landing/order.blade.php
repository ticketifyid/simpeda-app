<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Tiket — Ticketify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* ── Variables ── */
        :root {
            --primary: #D4A574;
            --primary-dark: #B8935F;
            --dark: #2C2C2C;
            --gray-100: #F5F5F5;
            --gray-200: #E8E8E8;
            --white: #FFFFFF;
            --muted: #666666;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Sora', sans-serif;
            background: var(--gray-100);
            color: var(--dark);
            overflow-x: hidden;
        }

        /* ── Navbar ── */
        nav {
            background: var(--dark);
            padding: 1.1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            font-size: 1.15rem;
            font-weight: 900;
            letter-spacing: 4px;
            color: var(--primary);
            text-decoration: none;
        }

        .nav-back {
            display: flex;
            align-items: center;
            gap: .4rem;
            font-size: .82rem;
            font-weight: 600;
            color: rgba(255, 255, 255, .5);
            text-decoration: none;
            transition: color .2s;
        }

        .nav-back:hover {
            color: var(--primary);
        }

        /* ── Page Header ── */
        .page-header {
            background: var(--dark);
            padding: 2.5rem 0;
            border-bottom: 3px solid var(--primary);
        }

        .page-header h1 {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--white);
            letter-spacing: -.5px;
            margin-bottom: .25rem;
        }

        .page-header p {
            font-size: .82rem;
            color: rgba(255, 255, 255, .45);
            margin: 0;
        }

        /* ── Ticket Summary Banner ── */
        .ticket-banner {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 12px;
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1.25rem;
            margin-bottom: 1.25rem;
            border-left: 4px solid var(--primary);
        }

        .ticket-banner-icon {
            width: 48px;
            height: 48px;
            background: var(--gray-100);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .ticket-banner-icon i {
            color: var(--primary);
            font-size: 1.3rem;
        }

        .ticket-banner-name {
            font-size: 1rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: .15rem;
        }

        .ticket-banner-price {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--primary-dark);
        }

        .ticket-banner-price small {
            font-size: .75rem;
            font-weight: 400;
            color: var(--muted);
        }

        /* ── Cards ── */
        .card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 12px;
            padding: 1.75rem;
            margin-bottom: 1.25rem;
        }

        .card-title {
            font-size: .9rem;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: .45rem;
            padding-bottom: .85rem;
            margin-bottom: 1.25rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .card-title i {
            color: var(--primary);
        }

        /* ── Form ── */
        .form-label {
            font-size: .78rem;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: .4rem;
        }

        .form-control {
            border: 1.5px solid var(--gray-200);
            border-radius: 8px;
            padding: .7rem 1rem;
            font-family: 'Sora', sans-serif;
            font-size: .88rem;
            color: var(--dark);
            transition: border-color .2s;
            background: var(--white);
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(212, 165, 116, .12);
            outline: none;
        }

        .form-text {
            font-size: .72rem;
            color: var(--muted);
            margin-top: .3rem;
        }

        /* ── Discount ── */
        .discount-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            user-select: none;
        }

        .discount-toggle-label {
            display: flex;
            align-items: center;
            gap: .5rem;
            font-size: .9rem;
            font-weight: 700;
            color: var(--dark);
        }

        .discount-toggle-label i {
            color: var(--primary);
        }

        .discount-opt {
            font-size: .7rem;
            font-weight: 600;
            letter-spacing: .5px;
            text-transform: uppercase;
            background: var(--gray-100);
            color: var(--muted);
            padding: .2rem .6rem;
            border-radius: 50px;
        }

        .discount-body {
            margin-top: 1.25rem;
        }

        .btn-apply {
            background: var(--primary);
            color: var(--dark);
            border: none;
            border-radius: 0 8px 8px 0;
            padding: .7rem 1.2rem;
            font-family: 'Sora', sans-serif;
            font-size: .82rem;
            font-weight: 700;
            cursor: pointer;
            white-space: nowrap;
            transition: background .2s;
        }

        .btn-apply:hover {
            background: var(--primary-dark);
            color: var(--white);
        }

        .discount-applied {
            background: #f0fdf4;
            border: 1px solid #86efac;
            border-radius: 8px;
            padding: .85rem 1rem;
            margin-top: .85rem;
            display: none;
            align-items: center;
            justify-content: space-between;
        }

        .discount-applied.show {
            display: flex;
        }

        .discount-applied-name {
            font-size: .88rem;
            font-weight: 700;
            color: #16a34a;
            margin-bottom: .1rem;
        }

        .discount-applied-value {
            font-size: .75rem;
            color: var(--muted);
        }

        .btn-remove {
            background: none;
            border: none;
            color: #ef4444;
            font-size: .82rem;
            cursor: pointer;
            padding: 0;
            flex-shrink: 0;
        }

        /* ── Summary Card ── */
        .summary-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 12px;
            padding: 1.75rem;
            position: sticky;
            top: 80px;
        }

        .summary-title {
            font-size: .9rem;
            font-weight: 700;
            color: var(--dark);
            padding-bottom: .85rem;
            margin-bottom: 1.25rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: .82rem;
            margin-bottom: .65rem;
        }

        .summary-row .lbl {
            color: var(--muted);
        }

        .summary-row .val {
            font-weight: 600;
            color: var(--dark);
        }

        .summary-row.discount .val {
            color: #16a34a;
        }

        .summary-divider {
            border-top: 1.5px dashed var(--gray-200);
            margin: 1rem 0;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .summary-total .lbl {
            font-size: .9rem;
            font-weight: 700;
            color: var(--dark);
        }

        .summary-total .val {
            font-size: 1.5rem;
            font-weight: 900;
            letter-spacing: -1px;
            color: var(--primary-dark);
        }

        .btn-submit {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            width: 100%;
            margin-top: 1.5rem;
            padding: .9rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--dark);
            border: none;
            border-radius: 8px;
            font-family: 'Sora', sans-serif;
            font-size: .9rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
            box-shadow: 0 4px 12px rgba(212, 165, 116, .3);
        }

        .btn-submit:hover {
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(212, 165, 116, .4);
        }

        .secure-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .35rem;
            margin-top: .85rem;
            font-size: .72rem;
            color: var(--muted);
        }

        .secure-note i {
            color: #16a34a;
        }

        /* ── Flash Alert ── */
        .flash-alert {
            border-radius: 10px;
            padding: .9rem 1.1rem;
            font-size: .85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: .6rem;
            margin-bottom: 1.25rem;
            border: none;
        }

        .flash-alert.error {
            background: #fef2f2;
            border-left: 4px solid #ef4444;
            color: #b91c1c;
        }

        .flash-alert.success {
            background: #f0fdf4;
            border-left: 4px solid #22c55e;
            color: #15803d;
        }

        .flash-alert i {
            font-size: 1rem;
            flex-shrink: 0;
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    <nav>
        <div class="container nav-inner">
            <a href="{{ route('landing') }}" class="logo">TICKETIFY</a>
            <a href="{{ route('landing') }}" class="nav-back">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </nav>

    {{-- Page Header --}}
    <div class="page-header">
        <div class="container">
            <h1><i class="bi bi-cart-check me-2"></i>Pemesanan</h1>
            <p>Lengkapi data di bawah untuk menyelesaikan pemesanan</p>
        </div>
    </div>

    <div class="container py-4">

        {{-- Flash Error --}}
        @if (session('error'))
            <div class="flash-alert error" role="alert">
                <i class="bi bi-exclamation-circle-fill"></i>
                {{ session('error') }}
            </div>
        @endif

        {{-- Flash Success --}}
        @if (session('success'))
            <div class="flash-alert success" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="row g-4">

            {{-- LEFT: Form --}}
            <div class="col-lg-8">

                {{-- Ticket Banner --}}
                <div class="ticket-banner">
                    <div class="ticket-banner-icon">
                        <i class="bi bi-ticket-perforated-fill"></i>
                    </div>
                    <div>
                        <div class="ticket-banner-name">{{ $ticket['name'] }}</div>
                        <div class="ticket-banner-price">
                            Rp {{ number_format($ticket['price'], 0, ',', '.') }}
                            <small>/ invitation</small>
                        </div>
                    </div>
                </div>

                {{-- Form --}}
                <form action="{{ route('landing.order.store') }}" method="POST" id="orderForm">
                    @csrf
                    <input type="hidden" name="ticket_id" value="{{ $ticket['id'] }}">
                    <input type="hidden" name="discount_id" id="selectedDiscountId" value="">

                    {{-- Data Pemesan --}}
                    <div class="card">
                        <div class="card-title">
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
                                <label class="form-label">Jumlah Invitation <span class="text-danger">*</span></label>
                                {{-- max dibatasi 4 atau stok tersedia, mana yang lebih kecil --}}
                                <input type="number" name="qty" id="inputQty" class="form-control" min="1"
                                    max="{{ min(4, $ticket['qty']) }}" value="{{ old('qty', 1) }}" required>
                                {{-- <div class="form-text">Maksimal 4 tiket per transaksi</div> --}}
                                @error('qty')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Diskon --}}
                    <div class="card">
                        <div class="discount-toggle" onclick="toggleDiscount()">
                            <div class="discount-toggle-label">
                                <i class="bi bi-tag-fill"></i>
                                Punya Kode Diskon?
                                <span class="discount-opt">Opsional</span>
                            </div>
                            <i class="bi bi-chevron-down" id="discountChevron"></i>
                        </div>

                        <div class="discount-body" id="discountBody" style="display:none;">
                            <label class="form-label mt-1">Masukkan Nama Diskon</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="discountInput"
                                    placeholder="Contoh: EARLYBIRD" style="border-radius: 8px 0 0 8px;">
                                <button type="button" class="btn-apply" onclick="applyDiscount()">Pakai</button>
                            </div>
                            <div id="discountError" class="text-danger small mt-1" style="display:none;">
                                Kode diskon tidak ditemukan atau sudah habis.
                            </div>
                            <div class="discount-applied" id="discountApplied">
                                <div>
                                    <div class="discount-applied-name" id="appliedDiscountName"></div>
                                    <div class="discount-applied-value" id="appliedDiscountValue"></div>
                                </div>
                                <button type="button" class="btn-remove" onclick="removeDiscount()">
                                    <i class="bi bi-x-circle-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            {{-- RIGHT: Summary --}}
            <div class="col-lg-4">
                <div class="summary-card">
                    <div class="summary-title">Ringkasan Invitation</div>

                    <div class="summary-row">
                        <span class="lbl">Invitation</span>
                        <span class="val">{{ $ticket['name'] }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="lbl">Nominal Hold</span>
                        <span class="val" id="summaryPrice">
                            Rp {{ number_format($ticket['price'], 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="summary-row">
                        <span class="lbl">Jumlah</span>
                        <span class="val" id="summaryQty">1 invitation</span>
                    </div>

                    <div class="summary-divider"></div>

                    <div class="summary-row">
                        <span class="lbl">Subtotal</span>
                        <span class="val" id="summarySubtotal">
                            Rp {{ number_format($ticket['price'], 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="summary-row discount" id="summaryDiscountRow" style="display:none;">
                        <span class="lbl">Diskon</span>
                        <span class="val" id="summaryDiscount">- Rp 0</span>
                    </div>

                    <div class="summary-divider"></div>

                    <div class="summary-total">
                        <span class="lbl">Total</span>
                        <span class="val" id="summaryTotal">
                            Rp {{ number_format($ticket['price'], 0, ',', '.') }}
                        </span>
                    </div>

                    <button type="submit" form="orderForm" class="btn-submit">
                        <i class="bi bi-lock-fill"></i> Dapatkan Invitation Sekarang
                    </button>

                    {{-- <div class="secure-note">
                        <i class="bi bi-shield-check-fill"></i> Transaksi aman & terenkripsi
                    </div> --}}
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const ticketPrice = {{ $ticket['price'] }};
        const discountsData = @json($discounts);
        let appliedDiscount = null;
        let discountAmount = 0;

        function formatRp(n) {
            return 'Rp ' + Math.round(n).toLocaleString('id-ID');
        }

        function updateSummary() {
            const qty = parseInt(document.getElementById('inputQty').value) || 1;
            const subtotal = ticketPrice * qty;
            let total = subtotal;

            if (appliedDiscount) {
                discountAmount = appliedDiscount.type === 'percentage' ?
                    subtotal * (appliedDiscount.price / 100) :
                    appliedDiscount.price;
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

        function toggleDiscount() {
            const body = document.getElementById('discountBody');
            const icon = document.getElementById('discountChevron');
            const open = body.style.display === 'none';
            body.style.display = open ? 'block' : 'none';
            icon.className = open ? 'bi bi-chevron-up' : 'bi bi-chevron-down';
        }

        function applyDiscount() {
            const input = document.getElementById('discountInput').value.trim().toLowerCase();
            const errorEl = document.getElementById('discountError');
            errorEl.style.display = 'none';

            if (!input) return alert('Masukkan nama diskon terlebih dahulu.');

            const found = discountsData.find(d => d.name.toLowerCase() === input);

            if (!found) {
                errorEl.style.display = 'block';
                return;
            }

            appliedDiscount = found;
            document.getElementById('selectedDiscountId').value = found.id;
            document.getElementById('appliedDiscountName').textContent = found.name;
            document.getElementById('appliedDiscountValue').textContent = found.type === 'percentage' ?
                found.price + '% potongan harga' :
                'Potongan Rp ' + parseFloat(found.price).toLocaleString('id-ID');

            document.getElementById('discountApplied').classList.add('show');
            updateSummary();
        }

        function removeDiscount() {
            appliedDiscount = null;
            document.getElementById('selectedDiscountId').value = '';
            document.getElementById('discountApplied').classList.remove('show');
            document.getElementById('discountInput').value = '';
            document.getElementById('discountError').style.display = 'none';
            updateSummary();
        }

        updateSummary();

        // Auto-scroll ke flash alert jika ada
        window.addEventListener('DOMContentLoaded', () => {
            const flash = document.querySelector('.flash-alert');
            if (flash) {
                flash.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });
    </script>
</body>

</html>

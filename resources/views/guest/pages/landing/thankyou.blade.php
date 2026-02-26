<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil — Ticketify</title>
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

        /* ─── Hero Success ─── */
        .success-hero {
            background: linear-gradient(135deg, var(--primary) 0%, #5548c8 100%);
            padding: 3rem 0 5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .success-hero::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, .05);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        .success-hero::after {
            content: '';
            position: absolute;
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, .04);
            border-radius: 50%;
            bottom: -80px;
            left: -60px;
        }

        .success-icon {
            width: 90px;
            height: 90px;
            background: rgba(255, 255, 255, .15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            animation: popIn .5s cubic-bezier(.175, .885, .32, 1.275) both;
        }

        .success-icon i {
            font-size: 2.5rem;
            color: #fff;
        }

        @keyframes popIn {
            from {
                transform: scale(0);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .success-hero h1 {
            color: #fff;
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: .5rem;
        }

        .success-hero p {
            color: rgba(255, 255, 255, .75);
            font-size: .95rem;
        }

        /* ─── Main Card ─── */
        .main-card {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 8px 40px rgba(61, 53, 148, .12);
            margin-top: -3rem;
            position: relative;
            z-index: 10;
            overflow: hidden;
        }

        /* ─── Ticket Stub ─── */
        .ticket-stub {
            padding: 2rem 2.5rem;
            border-bottom: 2px dashed #e8e8f0;
            position: relative;
        }

        .ticket-stub::before,
        .ticket-stub::after {
            content: '';
            position: absolute;
            bottom: -14px;
            width: 28px;
            height: 28px;
            background: var(--light-bg);
            border-radius: 50%;
        }

        .ticket-stub::before {
            left: -14px;
        }

        .ticket-stub::after {
            right: -14px;
        }

        .stub-badge {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            background: #f0fdf4;
            color: #16a34a;
            font-size: .8rem;
            font-weight: 700;
            padding: .3rem .8rem;
            border-radius: 50px;
            border: 1px solid #bbf7d0;
            margin-bottom: 1rem;
        }

        .stub-title {
            font-size: 1.3rem;
            font-weight: 800;
            color: #1a1a2e;
            margin-bottom: .25rem;
        }

        .stub-nobill {
            font-size: .85rem;
            color: #888;
            font-weight: 500;
        }

        .stub-nobill span {
            color: var(--primary);
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 1px;
        }

        /* ─── Detail Grid ─── */
        .detail-body {
            padding: 2rem 2.5rem;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.2rem;
        }

        @media (max-width: 576px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }

            .ticket-stub,
            .detail-body {
                padding: 1.5rem;
            }
        }

        .detail-item .label {
            font-size: .78rem;
            font-weight: 600;
            color: #aaa;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: .3rem;
        }

        .detail-item .value {
            font-size: .95rem;
            font-weight: 700;
            color: #1a1a2e;
        }

        /* ─── Payment Section ─── */
        .payment-section {
            background: var(--light-bg);
            border-radius: 16px;
            padding: 1.5rem;
            margin-top: 1.5rem;
        }

        .payment-section-title {
            font-size: .85rem;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 1rem;
        }

        .va-number {
            background: #fff;
            border: 2px solid var(--primary);
            border-radius: 12px;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .va-number .number {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary);
            letter-spacing: 2px;
        }

        .btn-copy {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: .5rem 1rem;
            font-size: .85rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: .4rem;
            transition: all .2s;
            white-space: nowrap;
        }

        .btn-copy:hover {
            background: var(--primary-dark);
        }

        .payment-info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: .6rem;
            font-size: .9rem;
        }

        .payment-info-row .label {
            color: #888;
        }

        .payment-info-row .value {
            font-weight: 700;
            color: #1a1a2e;
        }

        .payment-info-row .value.total {
            font-size: 1.2rem;
            color: var(--primary);
        }

        .payment-info-row .value.discount {
            color: #16a34a;
        }

        .payment-divider {
            border-top: 1px dashed #d1d5e8;
            margin: .8rem 0;
        }

        /* ─── Status Badge ─── */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .3rem .9rem;
            border-radius: 50px;
            font-size: .8rem;
            font-weight: 700;
        }

        .status-pending {
            background: #fef3c7;
            color: #d97706;
        }

        .status-paid {
            background: #d1fae5;
            color: #059669;
        }

        .status-failed {
            background: #fee2e2;
            color: #dc2626;
        }

        .status-expired {
            background: #f3f4f6;
            color: #6b7280;
        }

        /* ─── Deadline Alert ─── */
        .deadline-alert {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            border-radius: 12px;
            padding: 1rem 1.2rem;
            margin-top: 1rem;
            display: flex;
            align-items: flex-start;
            gap: .75rem;
        }

        .deadline-alert i {
            color: #f97316;
            font-size: 1.2rem;
            flex-shrink: 0;
            margin-top: .1rem;
        }

        .deadline-alert p {
            margin: 0;
            font-size: .85rem;
            color: #c2410c;
            font-weight: 500;
            line-height: 1.5;
        }

        /* ─── Actions ─── */
        .actions {
            padding: 1.5rem 2.5rem 2.5rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-home {
            background: linear-gradient(135deg, var(--primary) 0%, #5548c8 100%);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: .8rem 2rem;
            font-weight: 700;
            font-size: .95rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            transition: all .3s;
        }

        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(61, 53, 148, .3);
            color: #fff;
        }

        .btn-print {
            background: #fff;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 50px;
            padding: .8rem 2rem;
            font-weight: 700;
            font-size: .95rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            transition: all .2s;
        }

        .btn-print:hover {
            background: var(--light-bg);
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('landing') }}">
                <span>TICKETIFY</span>
            </a>
        </div>
    </nav>

    {{-- Success Hero --}}
    <div class="success-hero">
        <div class="container">
            <div class="success-icon">
                <i class="bi bi-check-lg"></i>
            </div>
            <h1>Pesanan Berhasil!</h1>
            <p>Selesaikan pembayaran sebelum batas waktu yang ditentukan</p>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">

                <div class="main-card">

                    {{-- Ticket Stub --}}
                    <div class="ticket-stub">
                        <div class="stub-badge">
                            <i class="bi bi-circle-fill" style="font-size:.5rem;"></i>
                            {{ strtoupper($order['status']) }}
                        </div>
                        <div class="stub-title">{{ $order['ticket']['name'] ?? ($ticket['name'] ?? 'Tiket') }}</div>
                        <div class="stub-nobill">
                            No. Tagihan: <span>{{ $order['no_bill'] }}</span>
                        </div>
                    </div>

                    {{-- Detail Body --}}
                    <div class="detail-body">

                        <div class="detail-grid">
                            <div class="detail-item">
                                <div class="label">Nama Pemesan</div>
                                <div class="value">{{ $order['nama'] }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="label">No. HP / WhatsApp</div>
                                <div class="value">{{ $order['no_hp'] }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="label">Email</div>
                                <div class="value">{{ $order['email'] }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="label">Jumlah Tiket</div>
                                <div class="value">{{ $order['qty'] }} tiket</div>
                            </div>
                            <div class="detail-item">
                                <div class="label">Tanggal Order</div>
                                <div class="value">
                                    {{ \Carbon\Carbon::parse($order['created_at'])->locale('id')->isoFormat('D MMMM YYYY, HH:mm') }}
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="label">Status</div>
                                <div class="value">
                                    @php $status = $order['status']; @endphp
                                    <span class="status-badge status-{{ $status }}">
                                        @if ($status === 'pending')
                                            <i class="bi bi-clock-fill"></i> Menunggu Pembayaran
                                        @elseif($status === 'paid')
                                            <i class="bi bi-check-circle-fill"></i> Lunas
                                        @elseif($status === 'failed')
                                            <i class="bi bi-x-circle-fill"></i> Gagal
                                        @else
                                            <i class="bi bi-dash-circle-fill"></i> Kadaluarsa
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Payment Section --}}
                        <div class="payment-section">
                            <div class="payment-section-title">
                                <i class="bi bi-credit-card-fill me-1"></i> Informasi Pembayaran
                            </div>

                            {{-- Virtual Account Number --}}
                            <div class="mb-3">
                                <div class="label"
                                    style="font-size:.78rem; font-weight:600; color:#aaa; text-transform:uppercase; letter-spacing:.5px; margin-bottom:.5rem;">
                                    Nomor Virtual Account
                                </div>
                                <div class="va-number">
                                    <span class="number">{{ $order['no_bill'] }}</span>
                                    <button class="btn-copy" onclick="copyVA()">
                                        <i class="bi bi-clipboard" id="copyIcon"></i> Salin
                                    </button>
                                </div>
                            </div>

                            {{-- Rincian --}}
                            <div class="payment-info-row">
                                <span class="label">Harga Tiket</span>
                                <span class="value">Rp
                                    {{ number_format($order['ticket']['price'] ?? ($ticket['price'] ?? 0), 0, ',', '.') }}</span>
                            </div>
                            <div class="payment-info-row">
                                <span class="label">Jumlah</span>
                                <span class="value">× {{ $order['qty'] }}</span>
                            </div>

                            @if (!empty($order['discount']))
                                <div class="payment-info-row">
                                    <span class="label">Diskon ({{ $order['discount']['name'] }})</span>
                                    <span class="value discount">
                                        @if ($order['discount']['type'] === 'percentage')
                                            - {{ $order['discount']['price'] }}%
                                        @else
                                            - Rp {{ number_format($order['discount']['price'], 0, ',', '.') }}
                                        @endif
                                    </span>
                                </div>
                            @endif

                            <div class="payment-divider"></div>

                            <div class="payment-info-row">
                                <span class="label" style="font-weight:700; font-size:1rem;">Total Pembayaran</span>
                                <span class="value total">Rp {{ number_format($order['total'], 0, ',', '.') }}</span>
                            </div>

                            {{-- Deadline Alert --}}
                            <div class="deadline-alert">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                <p>
                                    Selesaikan pembayaran dalam <strong>{{ $order['jatuh_tempo'] }} hari</strong>.
                                    Order yang tidak dibayar akan otomatis dibatalkan.
                                </p>
                            </div>
                        </div>

                    </div>

                    {{-- Actions --}}
                    <div class="actions">
                        <a href="{{ route('landing') }}" class="btn-home">
                            <i class="bi bi-house-fill"></i> Kembali ke Beranda
                        </a>
                        <button class="btn-print" onclick="window.print()">
                            <i class="bi bi-printer-fill"></i> Cetak
                        </button>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function copyVA() {
            const va = '{{ $order['no_bill'] }}';
            navigator.clipboard.writeText(va).then(() => {
                const icon = document.getElementById('copyIcon');
                icon.className = 'bi bi-clipboard-check';
                setTimeout(() => icon.className = 'bi bi-clipboard', 2000);
            });
        }
    </script>
</body>

</html>

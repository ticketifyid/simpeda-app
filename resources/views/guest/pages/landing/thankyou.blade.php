<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil — Ticketify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
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

        /* ── Success Hero ── */
        .success-hero {
            background: var(--dark);
            border-bottom: 3px solid var(--primary);
            padding: 3rem 0 5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .success-hero::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(212, 165, 116, .05);
            border-radius: 50%;
            top: -80px;
            right: -80px;
        }

        .success-hero::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(212, 165, 116, .04);
            border-radius: 50%;
            bottom: -60px;
            left: -40px;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: rgba(212, 165, 116, .15);
            border: 2px solid rgba(212, 165, 116, .3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            animation: popIn .5s cubic-bezier(.175, .885, .32, 1.275) both;
        }

        .success-icon i {
            font-size: 2.2rem;
            color: var(--primary);
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
            color: var(--white);
            font-size: 1.9rem;
            font-weight: 800;
            letter-spacing: -.5px;
            margin-bottom: .5rem;
        }

        .success-hero p {
            color: rgba(255, 255, 255, .45);
            font-size: .88rem;
        }

        /* ── Main Card ── */
        .main-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 14px;
            box-shadow: 0 8px 40px rgba(44, 44, 44, .1);
            margin-top: -3rem;
            position: relative;
            z-index: 10;
            overflow: hidden;
        }

        /* ── Ticket Stub ── */
        .ticket-stub {
            padding: 1.75rem 2rem;
            border-bottom: 2px dashed var(--gray-200);
            position: relative;
            background: var(--white);
        }

        .ticket-stub::before,
        .ticket-stub::after {
            content: '';
            position: absolute;
            bottom: -14px;
            width: 28px;
            height: 28px;
            background: var(--gray-100);
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
            font-size: .75rem;
            font-weight: 700;
            padding: .28rem .75rem;
            border-radius: 50px;
            border: 1px solid #bbf7d0;
            margin-bottom: .85rem;
        }

        .stub-title {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: .25rem;
        }

        .stub-nobill {
            font-size: .82rem;
            color: var(--muted);
            font-weight: 500;
        }

        .stub-nobill span {
            color: var(--primary-dark);
            font-weight: 700;
            font-size: .95rem;
            letter-spacing: 1px;
        }

        /* ── Detail Grid ── */
        .detail-body {
            padding: 1.75rem 2rem;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.2rem;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 576px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }

            .ticket-stub,
            .detail-body {
                padding: 1.25rem 1.5rem;
            }
        }

        .detail-item .label {
            font-size: .72rem;
            font-weight: 700;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: .3rem;
        }

        .detail-item .value {
            font-size: .92rem;
            font-weight: 700;
            color: var(--dark);
        }

        /* ── Status Badge ── */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .25rem .8rem;
            border-radius: 50px;
            font-size: .75rem;
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
            background: var(--gray-100);
            color: var(--muted);
        }

        /* ── Payment Section ── */
        .payment-section {
            background: var(--gray-100);
            border: 1px solid var(--gray-200);
            border-radius: 12px;
            padding: 1.5rem;
        }

        .payment-section-title {
            font-size: .72rem;
            font-weight: 700;
            color: var(--primary-dark);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1rem;
        }

        .va-number {
            background: var(--white);
            border: 2px solid var(--primary);
            border-radius: 10px;
            padding: .9rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .va-number .number {
            font-size: 1.35rem;
            font-weight: 900;
            color: var(--dark);
            letter-spacing: 2px;
        }

        .btn-copy {
            background: var(--primary);
            color: var(--dark);
            border: none;
            border-radius: 8px;
            padding: .45rem 1rem;
            font-family: 'Sora', sans-serif;
            font-size: .78rem;
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
            color: var(--white);
        }

        .payment-info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: .6rem;
            font-size: .85rem;
        }

        .payment-info-row .label {
            color: var(--muted);
        }

        .payment-info-row .value {
            font-weight: 700;
            color: var(--dark);
        }

        .payment-info-row .value.total {
            font-size: 1.15rem;
            color: var(--primary-dark);
        }

        .payment-info-row .value.discount {
            color: #16a34a;
        }

        .payment-divider {
            border-top: 1.5px dashed var(--gray-200);
            margin: .85rem 0;
        }

        /* ── Deadline Alert ── */
        .deadline-alert {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            border-radius: 10px;
            padding: .9rem 1.1rem;
            margin-top: 1rem;
            display: flex;
            align-items: flex-start;
            gap: .75rem;
        }

        .deadline-alert i {
            color: #f97316;
            font-size: 1.1rem;
            flex-shrink: 0;
            margin-top: .1rem;
        }

        .deadline-alert p {
            margin: 0;
            font-size: .82rem;
            color: #c2410c;
            font-weight: 500;
            line-height: 1.5;
        }

        /* ── Actions ── */
        .actions {
            padding: 1.25rem 2rem 2rem;
            display: flex;
            gap: .85rem;
            flex-wrap: wrap;
        }

        .btn-home {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--dark);
            border: none;
            border-radius: 8px;
            padding: .8rem 1.75rem;
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            font-size: .88rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            transition: all .2s;
            box-shadow: 0 4px 12px rgba(212, 165, 116, .3);
        }

        .btn-home:hover {
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(212, 165, 116, .4);
        }

        .btn-print {
            background: var(--white);
            color: var(--dark);
            border: 1.5px solid var(--gray-200);
            border-radius: 8px;
            padding: .8rem 1.75rem;
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            font-size: .88rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            transition: all .2s;
        }

        .btn-print:hover {
            border-color: var(--primary);
            color: var(--primary-dark);
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
                                    {{ \Carbon\Carbon::parse($order['created_at'])->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('D MMMM YYYY, HH:mm') }}
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

                            <div class="mb-3">
                                <div class="label"
                                    style="font-size:.72rem; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:.5px; margin-bottom:.5rem;">
                                    Nomor Virtual Account
                                </div>
                                <div class="va-number">
                                    <span class="number">{{ $order['no_bill'] }}</span>
                                    <button class="btn-copy" onclick="copyVA()">
                                        <i class="bi bi-clipboard" id="copyIcon"></i> Salin
                                    </button>
                                </div>
                            </div>

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
                                <span class="label" style="font-weight:700; font-size:.95rem;">Total Pembayaran</span>
                                <span class="value total">Rp {{ number_format($order['total'], 0, ',', '.') }}</span>
                            </div>

                            {{-- <div class="deadline-alert">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                <p>
                                    Selesaikan pembayaran dalam <strong>{{ $order['jatuh_tempo'] }} hari</strong>.
                                    Order yang tidak dibayar akan otomatis dibatalkan.
                                </p>
                            </div> --}}
                        </div>

                    </div>

                    {{-- Actions --}}
                    <div class="actions">
                        <a href="{{ route('landing') }}" class="btn-home">
                            <i class="bi bi-house-fill"></i> Kembali ke Beranda
                        </a>
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

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify</title>
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
            background: var(--white);
            color: var(--dark);
            overflow-x: hidden;
        }

        /* ── Navbar ── */
        nav {
            background: var(--dark);
            padding: 1.1rem 0;
            position: fixed;
            top: 0;
            width: 100%;
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

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }

        .nav-date {
            font-size: .72rem;
            font-weight: 500;
            letter-spacing: .5px;
            color: rgba(255, 255, 255, .4);
        }

        .nav-pill {
            background: var(--primary);
            color: var(--dark);
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: .35rem 1rem;
            border-radius: 50px;
        }

        /* ── Hero ── */
        .hero {
            padding: 8rem 0 5rem;
            background: var(--white);
            border-bottom: 1px solid var(--gray-200);
        }

        .hero-title {
            font-size: clamp(2rem, 4.5vw, 3.4rem);
            font-weight: 800;
            line-height: 1.12;
            letter-spacing: -1px;
            color: var(--dark);
            margin-bottom: 1.5rem;
        }

        .hero-title .highlight {
            color: var(--primary-dark);
        }

        .meta-strip {
            display: flex;
            flex-wrap: wrap;
            gap: .5rem;
            margin-bottom: 2.5rem;
        }

        .meta-chip {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            background: var(--gray-100);
            border: 1px solid var(--gray-200);
            color: var(--muted);
            font-size: .78rem;
            font-weight: 500;
            padding: .42rem .9rem;
            border-radius: 50px;
        }

        .meta-chip i {
            color: var(--primary);
            font-size: .82rem;
        }

        .btn-main {
            display: inline-flex;
            align-items: center;
            gap: .55rem;
            background: var(--primary);
            color: var(--dark);
            font-size: .88rem;
            font-weight: 700;
            padding: .9rem 2rem;
            border-radius: 6px;
            text-decoration: none;
            transition: all .2s;
        }

        .btn-main:hover {
            background: var(--primary-dark);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(212, 165, 116, .3);
        }

        /* ── Poster ── */
        .poster-wrap {
            position: relative;
        }

        .poster-box {
            aspect-ratio: 3/4;
            max-height: 480px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: var(--gray-100);
            border: 1px solid var(--gray-200);
            border-radius: 14px;
            box-shadow: 0 24px 60px rgba(44, 44, 44, .12);
        }

        .poster-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .poster-placeholder {
            text-align: center;
            color: rgba(44, 44, 44, .2);
        }

        .poster-placeholder i {
            font-size: 2.5rem;
            display: block;
            margin-bottom: .5rem;
        }

        .poster-placeholder span {
            font-size: .78rem;
        }

        .poster-badge {
            position: absolute;
            bottom: -14px;
            left: -16px;
            background: var(--dark);
            border: 1px solid rgba(212, 165, 116, .2);
            border-radius: 10px;
            padding: .9rem 1.25rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .2);
        }

        .poster-badge-num {
            font-size: 1.4rem;
            font-weight: 900;
            line-height: 1;
            color: var(--primary);
        }

        .poster-badge-text {
            font-size: .65rem;
            font-weight: 500;
            letter-spacing: .5px;
            color: rgba(255, 255, 255, .5);
        }

        /* ── Tickets Section ── */
        .tickets-section {
            background: var(--gray-100);
            padding: 5rem 0 6rem;
        }

        .section-top {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: .75rem;
            margin-bottom: 2.5rem;
        }

        .section-eyebrow {
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--primary-dark);
            margin-bottom: .35rem;
        }

        .section-title {
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: -.5px;
            color: var(--dark);
        }

        .section-sub {
            font-size: .8rem;
            color: var(--muted);
        }

        /* ── Ticket Card ── */
        .tcard {
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 12px;
            transition: all .25s;
        }

        .tcard:hover {
            transform: translateY(-4px);
            border-color: var(--primary);
            box-shadow: 0 16px 40px rgba(44, 44, 44, .1);
        }

        .tcard-top {
            position: relative;
            overflow: hidden;
            background: var(--dark);
            padding: 1.5rem 1.75rem 1.25rem;
        }

        /* Decorative circle */
        .tcard-top::after {
            content: '';
            position: absolute;
            right: -20px;
            top: -20px;
            width: 80px;
            height: 80px;
            background: rgba(212, 165, 116, .08);
            border-radius: 50%;
        }

        .tcard-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(212, 165, 116, .15);
            border-radius: 8px;
            margin-bottom: .85rem;
        }

        .tcard-icon i {
            color: var(--primary);
            font-size: .95rem;
        }

        .tcard-name {
            font-size: 1rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: .25rem;
        }

        .tcard-stock {
            font-size: .72rem;
            color: rgba(255, 255, 255, .4);
        }

        .tcard-stock strong {
            color: var(--primary);
        }

        /* Ticket perforation */
        .tcard-perf {
            position: relative;
            height: 20px;
            background: var(--white);
        }

        .tcard-perf::before,
        .tcard-perf::after {
            content: '';
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            background: var(--gray-100);
            border-radius: 50%;
        }

        .tcard-perf::before {
            left: -8px;
        }

        .tcard-perf::after {
            right: -8px;
        }

        .tcard-perf-line {
            position: absolute;
            top: 50%;
            left: 14px;
            right: 14px;
            border-top: 1.5px dashed var(--gray-200);
        }

        .tcard-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 1.25rem 1.75rem 1.5rem;
        }

        .tcard-price {
            font-size: 1.65rem;
            font-weight: 900;
            letter-spacing: -1px;
            color: var(--dark);
            margin-bottom: .1rem;
        }

        .tcard-per {
            font-size: .72rem;
            color: var(--muted);
            margin-bottom: 1.25rem;
        }

        .btn-pick {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--dark);
            font-size: .82rem;
            font-weight: 700;
            padding: .8rem 1.1rem;
            border-radius: 8px;
            text-decoration: none;
            transition: all .2s;
            box-shadow: 0 4px 12px rgba(212, 165, 116, .3);
        }

        .btn-pick:hover {
            color: var(--white);
            box-shadow: 0 6px 20px rgba(212, 165, 116, .4);
        }

        /* Sold out state */
        .sold-out .tcard-top {
            background: #555;
        }

        .sold-out .btn-pick {
            background: var(--gray-200);
            color: var(--muted);
            pointer-events: none;
            box-shadow: none;
        }

        .sold-badge {
            display: inline-block;
            margin-left: .4rem;
            padding: .1rem .45rem;
            font-size: .6rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #e53935;
            border: 1px solid #e53935;
            border-radius: 4px;
            vertical-align: middle;
        }

        .empty {
            text-align: center;
            padding: 4rem 0;
            font-size: .9rem;
            color: var(--muted);
        }

        /* ── Footer ── */
        footer {
            background: var(--dark);
            border-top: 3px solid var(--primary);
            padding: 1.5rem 0;
        }

        .footer-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: .5rem;
        }

        footer p {
            margin: 0;
            font-size: .75rem;
            color: rgba(255, 255, 255, .35);
        }

        footer strong {
            color: var(--primary);
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    <nav>
        <div class="container nav-inner">
            <a href="{{ route('landing') }}" class="logo">TICKETIFY</a>
            <div class="nav-right">
                {{-- <span class="nav-date d-none d-md-block">{{ $event['date'] ?? '28 Juni 2025' }}</span> --}}
                <span class="nav-pill">Cek Tiket Anda</span>
            </div>
        </div>
    </nav>

    {{-- Hero --}}
    <section class="hero">
        <div class="container">
            <div class="row align-items-center g-5">

                <div class="col-lg-7">
                    <h1 class="hero-title">
                        {{ $event['name'] ?? 'Simpeda Festival' }}<br>
                        <span class="highlight">{{ $event['city'] ?? 'Semarang' }}</span>
                    </h1>
                    <div class="meta-strip">
                        <span class="meta-chip">
                            <i class="bi bi-calendar3"></i> {{ $event['date'] ?? '28 Juni 2025' }}
                        </span>
                        <span class="meta-chip">
                            <i class="bi bi-geo-alt"></i> {{ $event['location'] ?? 'Simpang Lima, Semarang' }}
                        </span>
                        @isset($event['time'])
                            <span class="meta-chip">
                                <i class="bi bi-clock"></i> {{ $event['time'] }}
                            </span>
                        @endisset
                    </div>
                    <a href="#tickets" class="btn-main">
                        <i class="bi bi-ticket-perforated-fill"></i> Beli Tiket Sekarang
                    </a>
                </div>

                <div class="col-lg-5 d-flex justify-content-center justify-content-lg-end">
                    <div class="poster-wrap" style="max-width:360px; width:100%;">
                        <div class="poster-box">
                            @isset($event['poster'])
                                <img src="{{ $event['poster'] }}" alt="Poster {{ $event['name'] ?? 'Event' }}">
                            @else
                                <div class="poster-placeholder">
                                    <i class="bi bi-image-fill"></i>
                                    <span>Poster Event</span>
                                </div>
                            @endisset
                        </div>
                        <div class="poster-badge">
                            <div class="poster-badge-num">{{ count($tickets) }}</div>
                            <div class="poster-badge-text">Kategori Tiket</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Tickets --}}
    <section class="tickets-section" id="tickets">
        <div class="container">

            <div class="section-top">
                <div>
                    <div class="section-eyebrow">Pilih Tiketmu</div>
                    <div class="section-title">Kategori Tiket</div>
                </div>
                <div class="section-sub">{{ count($tickets) }} jenis tiket tersedia</div>
            </div>

            @if (empty($tickets))
                <div class="empty">Belum ada tiket tersedia.</div>
            @else
                <div class="row g-4">
                    @foreach ($tickets as $ticket)
                        <div class="col-sm-6 col-lg-4">
                            <div class="tcard {{ $ticket['qty'] <= 0 ? 'sold-out' : '' }}">

                                <div class="tcard-top">
                                    <div class="tcard-icon">
                                        <i class="bi bi-ticket-perforated-fill"></i>
                                    </div>
                                    <div class="tcard-name">
                                        {{ $ticket['name'] }}
                                        @if ($ticket['qty'] <= 0)
                                            <span class="sold-badge">Sold Out</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="tcard-perf">
                                    <div class="tcard-perf-line"></div>
                                </div>

                                <div class="tcard-body">
                                    <div class="tcard-price">
                                        Rp {{ number_format($ticket['price'], 0, ',', '.') }}
                                    </div>
                                    <div class="tcard-per">per tiket</div>
                                    <a href="{{ route('landing.order', $ticket['id']) }}" class="btn-pick">
                                        Pilih Tiket <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </section>

    {{-- Footer --}}
    <footer>
        <div class="container footer-inner">
            <p><strong>Ticketify</strong> — Platform Tiket Event</p>
            <p>&copy; {{ date('Y') }} All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('[href="#tickets"]').forEach(el => {
            el.addEventListener('click', e => {
                e.preventDefault();
                document.getElementById('tickets').scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>

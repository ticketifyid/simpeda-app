<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify — Get Your Tickets</title>
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
            background: #fff;
            color: #1a1a2e;
        }

        /* ─── Navbar ─── */
        .navbar {
            background: var(--primary);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 20px rgba(61, 53, 148, .3);
        }

        .navbar-brand img {
            height: 36px;
        }

        .navbar-brand span {
            color: var(--accent);
            font-weight: 800;
            font-size: 1.4rem;
            letter-spacing: 1px;
        }

        /* ─── Hero ─── */
        .hero {
            background: linear-gradient(135deg, var(--primary) 0%, #5548c8 60%, #2e2870 100%);
            min-height: 92vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: rgba(245, 166, 35, .08);
            top: -150px;
            right: -150px;
        }

        .hero::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(232, 118, 44, .07);
            bottom: -100px;
            left: -100px;
        }

        .hero-badge {
            background: rgba(245, 166, 35, .15);
            border: 1px solid rgba(245, 166, 35, .4);
            color: var(--accent);
            padding: .4rem 1rem;
            border-radius: 50px;
            font-size: .8rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 1.2rem;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .hero h1 {
            font-size: clamp(2.2rem, 5vw, 3.8rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.15;
        }

        .hero h1 span {
            color: var(--accent);
        }

        .hero p {
            color: rgba(255, 255, 255, .75);
            font-size: 1.1rem;
            line-height: 1.8;
            max-width: 520px;
        }

        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin: 1.8rem 0;
        }

        .hero-meta-item {
            display: flex;
            align-items: center;
            gap: .5rem;
            color: rgba(255, 255, 255, .85);
            font-size: .95rem;
        }

        .hero-meta-item i {
            color: var(--accent);
            font-size: 1.1rem;
        }

        .btn-accent {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);
            color: #fff;
            font-weight: 700;
            padding: .85rem 2rem;
            border-radius: 50px;
            border: none;
            font-size: 1rem;
            box-shadow: 0 8px 24px rgba(245, 166, 35, .4);
            transition: all .3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
        }

        .btn-accent:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(245, 166, 35, .5);
            color: #fff;
        }

        .hero-poster {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0, 0, 0, .4);
            transform: perspective(1000px) rotateY(-5deg);
            transition: transform .5s ease;
            position: relative;
            z-index: 1;
        }

        .hero-poster:hover {
            transform: perspective(1000px) rotateY(0deg);
        }

        .hero-poster img {
            width: 100%;
            max-width: 420px;
            display: block;
        }

        .poster-placeholder {
            width: 100%;
            max-width: 420px;
            height: 480px;
            background: rgba(255, 255, 255, .08);
            border: 2px dashed rgba(255, 255, 255, .2);
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, .4);
            gap: .5rem;
        }

        .poster-placeholder i {
            font-size: 3rem;
        }

        /* ─── Tickets Section ─── */
        .tickets-section {
            background: var(--light-bg);
            padding: 80px 0;
        }

        .section-label {
            color: var(--primary);
            font-weight: 700;
            font-size: .8rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            display: block;
            margin-bottom: .5rem;
        }

        .section-title {
            font-size: clamp(1.6rem, 3vw, 2.2rem);
            font-weight: 800;
            color: #1a1a2e;
        }

        .section-title span {
            color: var(--primary);
        }

        .ticket-card {
            background: #fff;
            border-radius: 20px;
            padding: 2rem;
            border: 2px solid transparent;
            box-shadow: 0 4px 24px rgba(61, 53, 148, .07);
            transition: all .3s ease;
            position: relative;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .ticket-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            transform: scaleX(0);
            transition: transform .3s ease;
        }

        .ticket-card:hover {
            border-color: rgba(61, 53, 148, .15);
            box-shadow: 0 12px 40px rgba(61, 53, 148, .15);
            transform: translateY(-4px);
        }

        .ticket-card:hover::before {
            transform: scaleX(1);
        }

        .ticket-icon {
            width: 52px;
            height: 52px;
            background: var(--light-bg);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.2rem;
        }

        .ticket-icon i {
            color: var(--primary);
            font-size: 1.4rem;
        }

        .ticket-name {
            font-size: 1.15rem;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: .4rem;
        }

        .ticket-qty {
            font-size: .85rem;
            color: #888;
            margin-bottom: 1.2rem;
        }

        .ticket-qty span {
            color: var(--primary);
            font-weight: 600;
        }

        .ticket-price {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 1.5rem;
            margin-top: auto;
        }

        .ticket-price small {
            font-size: .75rem;
            font-weight: 400;
            color: #aaa;
            display: block;
        }

        .btn-pick {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: .7rem 1.5rem;
            font-weight: 700;
            font-size: .9rem;
            width: 100%;
            transition: all .3s ease;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .btn-pick:hover {
            background: var(--primary-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        .sold-out .btn-pick {
            background: #e0e0e0;
            color: #aaa;
            pointer-events: none;
        }

        .badge-sold {
            position: absolute;
            top: 1.2rem;
            right: 1.2rem;
            background: #ffe5e5;
            color: #e53935;
            font-size: .7rem;
            font-weight: 700;
            padding: .3rem .7rem;
            border-radius: 50px;
        }

        /* ─── Footer ─── */
        .footer {
            background: var(--primary);
            color: rgba(255, 255, 255, .6);
            text-align: center;
            padding: 2rem;
            font-size: .875rem;
        }

        .footer strong {
            color: var(--accent);
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <span>TICKETIFY</span>
            </a>
        </div>
    </nav>

    {{-- Hero --}}
    <section class="hero">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="hero-badge">
                        <i class="bi bi-lightning-charge-fill me-1"></i> Event 2025
                    </div>
                    <h1>Grand Music <span>Festival</span> Semarang</h1>
                    <p>Rayakan momen terbaik bersama ribuan penonton di event musik terbesar tahun ini. Jangan lewatkan
                        penampilan artis-artis top tanah air!</p>
                    <div class="hero-meta">
                        <div class="hero-meta-item">
                            <i class="bi bi-calendar-event-fill"></i>
                            <span>28 Juni 2025</span>
                        </div>
                        <div class="hero-meta-item">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span>Lapangan Simpang Lima, Semarang</span>
                        </div>
                        <div class="hero-meta-item">
                            <i class="bi bi-clock-fill"></i>
                            <span>15.00 — 23.00 WIB</span>
                        </div>
                    </div>
                    <a href="#tickets" class="btn-accent">
                        <i class="bi bi-ticket-perforated-fill"></i>
                        Beli Tiket Sekarang
                    </a>
                </div>
                <div class="col-lg-6 d-flex justify-content-center justify-content-lg-end">
                    <div class="hero-poster">
                        {{-- Ganti src dengan poster asli nanti --}}
                        <div class="poster-placeholder">
                            <i class="bi bi-image"></i>
                            <span>Poster Event</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Tickets Section --}}
    <section class="tickets-section" id="tickets">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-label">Pilih Tiketmu</span>
                <h2 class="section-title">Tersedia <span>{{ count($tickets) }} Jenis</span> Tiket</h2>
            </div>

            @if (empty($tickets))
                <div class="text-center py-5">
                    <i class="bi bi-ticket-x" style="font-size:3rem; color:#ccc;"></i>
                    <p class="text-muted mt-3">Belum ada tiket yang tersedia saat ini.</p>
                </div>
            @else
                <div class="row g-4 justify-content-center">
                    @foreach ($tickets as $ticket)
                        <div class="col-sm-6 col-lg-4">
                            <div class="ticket-card {{ $ticket['qty'] <= 0 ? 'sold-out' : '' }}">
                                @if ($ticket['qty'] <= 0)
                                    <span class="badge-sold">Sold Out</span>
                                @endif
                                <div class="ticket-icon">
                                    <i class="bi bi-ticket-perforated"></i>
                                </div>
                                <div class="ticket-name">{{ $ticket['name'] }}</div>
                                <div class="ticket-qty">
                                    Sisa: <span>{{ $ticket['qty'] }} tiket</span>
                                </div>
                                <div class="ticket-price">
                                    Rp {{ number_format($ticket['price'], 0, ',', '.') }}
                                    <small>per tiket</small>
                                </div>
                                <a href="{{ route('landing.order', $ticket['id']) }}" class="btn-pick">
                                    Pilih Tiket <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- Footer --}}
    <footer class="footer">
        <p class="mb-0">&copy; {{ date('Y') }} <strong>Ticketify</strong>. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scroll
        document.querySelector('[href="#tickets"]').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('tickets').scrollIntoView({
                behavior: 'smooth'
            });
        });
    </script>
</body>

</html>

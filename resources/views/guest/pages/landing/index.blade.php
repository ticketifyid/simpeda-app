<!DOCTYPE html>
<html lang="id">

<head>
    <base href="{{ url('/') }}/" />
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
            padding: 8rem 0 3rem;
            background: var(--white);
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
            max-height: 600px;
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

        /* ── Syarat & Ketentuan ── */
        .snk-section {
            background: var(--white);
            padding: 0 0 6rem;
        }

        .snk-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 14px;
            overflow: hidden;
            height: 100%;
        }

        .snk-card-header {
            display: flex;
            align-items: center;
            gap: .85rem;
            background: var(--dark);
            padding: 1.1rem 1.5rem;
        }

        .snk-card-icon {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(212, 165, 116, .15);
            border-radius: 8px;
            flex-shrink: 0;
        }

        .snk-card-icon i {
            color: var(--primary);
            font-size: .95rem;
        }

        .snk-card-title {
            font-size: .95rem;
            font-weight: 700;
            letter-spacing: .3px;
            color: var(--white);
        }

        .snk-list {
            padding: 1.5rem 1.75rem 1.5rem 2.5rem;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: .75rem;
        }

        .snk-list li {
            font-size: .82rem;
            line-height: 1.65;
            color: var(--muted);
        }

        /* Accordion overrides */
        .snk-accordion {
            padding: .75rem 1rem 1rem;
            display: flex;
            flex-direction: column;
            gap: .5rem;
        }

        .snk-acc-item {
            border: 1px solid var(--gray-200) !important;
            border-radius: 8px !important;
            overflow: hidden;
        }

        .snk-acc-btn {
            font-size: .82rem;
            font-weight: 700;
            color: var(--dark) !important;
            background: var(--gray-100) !important;
            padding: .75rem 1rem;
            box-shadow: none !important;
        }

        .snk-acc-btn:not(.collapsed) {
            background: var(--dark) !important;
            color: var(--white) !important;
        }

        .snk-acc-btn:not(.collapsed) i {
            color: var(--primary);
        }

        .snk-acc-btn::after {
            filter: none;
        }

        .snk-acc-btn:not(.collapsed)::after {
            filter: invert(1);
        }

        .snk-acc-body {
            padding: 1rem 1.25rem;
            font-size: .8rem;
        }

        .snk-acc-body ol {
            padding-left: 1.25rem;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: .6rem;
        }

        .snk-acc-body li {
            color: var(--muted);
            line-height: 1.65;
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
                {{-- <span class="nav-pill">Cek Tiket Anda</span> --}}
            </div>
        </div>
    </nav>

    {{-- Hero --}}
    <section class="hero">
        <div class="container">
            <div class="row align-items-center g-5">

                <div class="col-lg-7">
                    <h1 class="hero-title">
                        {{ $event['name'] ?? 'Saveduit' }}<br>
                        <span class="highlight">{{ $event['city'] ?? 'Sinergi Nusantara' }}</span>
                    </h1>
                    <div class="meta-strip">
                        <span class="meta-chip">
                            <i class="bi bi-calendar3"></i> {{ $event['date'] ?? '17 April 2026' }}
                        </span>
                        <span class="meta-chip">
                            <i class="bi bi-geo-alt"></i> {{ $event['location'] ?? 'Grand Ballroom Alila, Solo' }}
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
                    <div class="poster-wrap" style="max-width:460px; width:100%; padding-bottom: 2rem;">
                        <div class="poster-box">
                            @isset($event['poster'])
                                <img src="{{ asset('assets/media/poster/poster-1.jpeg') }}"
                                    alt="Poster {{ $event['name'] ?? 'Event' }}">
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

    <section class="snk-section" id="syarat-ketentuan">
        <div class="container">

            <div class="section-top">
                <div>
                    <div class="section-eyebrow">Baca Sebelum Membeli</div>
                    <div class="section-title">Syarat &amp; Ketentuan</div>
                </div>
            </div>

            <div class="snk-card">
                <div class="snk-card-header">
                    <div class="snk-card-icon"><i class="bi bi-file-earmark-text-fill"></i></div>
                    <span class="snk-card-title">Nasabah dengan ini telah membaca, memahami, mengerti dan secara sadar
                        menyetujui syarat dan ketentuan program sebagai berikut :</span>
                </div>

                <div
                    style="
                max-height: 320px;
                overflow-y: auto;
                padding: 1.5rem 1.75rem 1.5rem 2.5rem;
                scrollbar-width: thin;
                scrollbar-color: var(--primary) var(--gray-100);
            ">
                    <ol style="margin:0; display:flex; flex-direction:column; gap:.75rem;">
                        <li style="font-size:.82rem; line-height:1.65; color:var(--muted);">Invitation akan didapatkan
                            dalam bentuk softcopy.</li>
                        <li style="font-size:.82rem; line-height:1.65; color:var(--muted);">Tukarkan invitation dengan
                            akses masuk di area acara.</li>
                        <li style="font-size:.82rem; line-height:1.65; color:var(--muted);">Hold dana/ lock dana/ kunci
                            saldo selama <strong>12 (dua belas) bulan</strong>.</li>
                        <li style="font-size:.82rem; line-height:1.65; color:var(--muted);">Registrasi hanya dapat
                            dilakukan melalui website <strong>Ticketify.id</strong> dan hold dana hanya dapat dilakukan
                            melalui aplikasi Bima Mobile Bank Jateng pada menu saveduit.</li>
                        <li style="font-size:.82rem; line-height:1.65; color:var(--muted);">Peserta wajib menyelesaikan
                            transaksi Saveduit melalui aplikasi Bima Mobile Bank Jateng, serta secara sadar melakukan
                            transaksi Saveduit/ lock up/ hold saldo pada rekening Bank Jateng.</li>
                        <li style="font-size:.82rem; line-height:1.65; color:var(--muted);">Saldo yang telah dikunci
                            hanya bisa di cek datanya melalui Customer Service di kantor Bank Jateng terdekat.</li>
                        <li style="font-size:.82rem; line-height:1.65; color:var(--muted);">Dengan melakukan transaksi
                            di channel Bank Jateng (Bima Mobile) maka nasabah secara sadar memerintahkan bank untuk
                            mengunci saldo dengan nominal saveduit pada rekening pribadi sesuai ketentuan di dalam
                            rekening dengan jangka waktu yang diperjanjikan.</li>
                        <li style="font-size:.82rem; line-height:1.65; color:var(--muted);">Saldo yang dikunci tidak
                            dapat dipindahkan ataupun ditarik sebelum jangka waktu kunci berakhir. Saldo yang terkunci
                            akan dikenakan biaya administrasi tabungan sesuai syarat dan ketentuan produk layanan.</li>
                        <li style="font-size:.82rem; line-height:1.65; color:var(--muted);">Apabila sebelum berakhirnya
                            jatuh tempo penguncian/ blokir dana pemilik rekening melakukan penarikan dana atau pencairan
                            dana yang diblokir baik sebagian atau seluruhnya, maka yang bersangkutan bersedia dikenakan
                            <strong>denda sebesar Rp 1.000.000,-/ invitation</strong>. Bank Jateng untuk melakukan
                            pendebetan atas rekening tersebut diatas sebesar denda yang ditetapkan Bank Jateng.
                        </li>
                        <li style="font-size:.82rem; line-height:1.65; color:var(--muted);">Nasabah dengan sadar
                            mengenali nomor rekening yang terblokir sebagai rekening blokir/ penguncian saldo tabungan,
                            dan tidak dapat menggugat Bank Jateng atas transaksi blokir yang telah dilaksanakan melalui
                            Bima Mobile.</li>
                        <li style="font-size:.82rem; line-height:1.65; color:var(--muted);">Nasabah yang telah
                            menyelesaikan transaksi lock/ hold maka telah menyetujui syarat dan ketentuan program.</li>
                        <li style="font-size:.82rem; line-height:1.65; color:var(--muted);">Untuk keterangan lebih
                            lanjut dan/ atau masalah pengaduan dapat menghubungi call center Bank Jateng di nomor
                            <strong>14066</strong>.
                        </li>
                        <li style="font-size:.82rem; line-height:1.65; color:var(--muted);">Bilamana penyelenggara acara
                            tidak dapat dilaksanakan dikarenakan adanya ketentuan Pemerintah atau dikarenakan kondisi
                            <em>force majeur</em> belum berakhir dan apabila pihak Bank Jateng setuju untuk melakukan
                            refund semua biaya pendaftaran penonton yang sudah didapat, maka pihak Bank Jateng akan
                            membebaskan denda dan jangka waktu blokir bagi pemilik rekening yang sudah melakukan lock/
                            hold.
                        </li>
                        <li style="font-size:.82rem; line-height:1.65; color:var(--muted);">Jaga kerahasiaan data dan
                            penggunaan invitation yang sudah diterima nasabah menjadi sepenuhnya tanggung jawab nasabah.
                        </li>
                        <li style="font-size:.82rem; line-height:1.65; color:var(--muted);">Kuota terbatas dan selama
                            persediaan masih ada.</li>
                    </ol>
                </div>

                {{-- Fade & hint scroll --}}
                <div
                    style="
                text-align:center;
                padding: .6rem 1rem .9rem;
                font-size:.72rem;
                color:var(--muted);
                border-top: 1px solid var(--gray-200);
            ">
                    <i class="bi bi-chevron-double-down" style="color:var(--primary);"></i>
                    Gulir untuk membaca selengkapnya
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
            <p><strong>Ticketify</strong></p>
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

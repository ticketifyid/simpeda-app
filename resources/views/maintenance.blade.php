<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Under Maintenance — Ticketify</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@400;600;800&display=swap"
        rel="stylesheet" />
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg: #2e2b7a;
            --surface: #35328a;
            --border: rgba(255, 255, 255, 0.1);
            --accent: #f5a800;
            --accent2: #e8642a;
            --text: #ffffff;
            --muted: rgba(255, 255, 255, 0.5);
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Syne', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.04) 1px, transparent 1px);
            background-size: 60px 60px;
            z-index: 0;
            animation: gridShift 20s linear infinite;
        }

        @keyframes gridShift {
            0% {
                background-position: 0 0;
            }

            100% {
                background-position: 60px 60px;
            }
        }

        .orb {
            position: fixed;
            border-radius: 50%;
            z-index: 0;
            animation: orbPulse 6s ease-in-out infinite;
        }

        .orb1 {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(245, 168, 0, 0.15) 0%, transparent 70%);
            top: -120px;
            right: -100px;
        }

        .orb2 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(232, 100, 42, 0.12) 0%, transparent 70%);
            bottom: -100px;
            left: -80px;
            animation-delay: 3s;
        }

        @keyframes orbPulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.15);
                opacity: 0.7;
            }
        }

        .card {
            position: relative;
            z-index: 1;
            max-width: 560px;
            width: 90%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 56px 48px;
            backdrop-filter: blur(12px);
            animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(32px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 40px;
            animation: fadeUp 0.8s 0.1s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .logo-text {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 18px;
            letter-spacing: 0.12em;
            color: var(--accent);
        }

        .tag {
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.15em;
            color: var(--accent2);
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 28px;
            animation: fadeUp 0.8s 0.15s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .tag::before {
            content: '';
            display: inline-block;
            width: 6px;
            height: 6px;
            background: var(--accent2);
            border-radius: 50%;
            animation: blink 1.4s ease-in-out infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.2;
            }
        }

        /* Gear icon replacing error code */
        .gear-wrap {
            margin-bottom: 20px;
            animation: fadeUp 0.8s 0.2s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .gear-wrap svg {
            animation: spin 8s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        h1 {
            font-size: 26px;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 16px;
            animation: fadeUp 0.8s 0.25s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        p {
            font-size: 15px;
            color: var(--muted);
            line-height: 1.75;
            margin-bottom: 40px;
            animation: fadeUp 0.8s 0.3s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        p strong {
            color: var(--text);
            font-weight: 600;
        }


        .divider {
            height: 1px;
            background: var(--border);
            margin-bottom: 32px;
            animation: fadeUp 0.8s 0.35s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .contact-label {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            letter-spacing: 0.15em;
            color: var(--muted);
            text-transform: uppercase;
            margin-bottom: 12px;
            animation: fadeUp 0.8s 0.4s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .contact-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 24px;
            background: var(--accent);
            border: none;
            border-radius: 4px;
            color: var(--bg);
            font-family: 'Space Mono', monospace;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: background 0.2s, transform 0.15s;
            animation: fadeUp 0.8s 0.45s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .contact-btn:hover {
            background: var(--accent2);
            transform: translateY(-2px);
        }

        .contact-btn svg {
            width: 16px;
            height: 16px;
        }

        .footer {
            margin-top: 48px;
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            color: var(--muted);
            display: flex;
            justify-content: space-between;
            align-items: center;
            animation: fadeUp 0.8s 0.5s cubic-bezier(0.16, 1, 0.3, 1) both;
        }
    </style>
</head>

<body>

    <div class="orb orb1"></div>
    <div class="orb orb2"></div>

    <div class="card">

        <div class="logo">
            <svg width="38" height="38" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="33" cy="18" r="10" fill="#f5a800" />
                <circle cx="67" cy="18" r="10" fill="#f5a800" />
                <path d="M5 80 C25 45 75 45 95 80" fill="#e8642a" />
                <path d="M18 82 C38 42 80 42 97 72" fill="#f5a800" />
            </svg>
            <span class="logo-text">TICKETIFY</span>
        </div>

        <div class="tag">System Status</div>

        <!-- Spinning gear -->
        <div class="gear-wrap">
            <svg width="52" height="52" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" fill="var(--accent)" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M9.35 3.22a1.5 1.5 0 0 1 1.32-.72h2.66c.55 0 1.05.3 1.32.77l.56.97a7.06 7.06 0 0 1 1.56.9l1.1-.28c.53-.14 1.1.04 1.46.46l1.33 1.53c.36.42.44 1.01.2 1.5l-.5 1.02c.13.52.2 1.05.2 1.6s-.07 1.08-.2 1.6l.5 1.01c.24.49.16 1.08-.2 1.5l-1.33 1.54a1.5 1.5 0 0 1-1.46.45l-1.1-.27a7.07 7.07 0 0 1-1.56.9l-.56.97A1.5 1.5 0 0 1 13.33 20H10.67c-.55 0-1.05-.3-1.32-.77l-.56-.97a7.07 7.07 0 0 1-1.56-.9l-1.1.28a1.5 1.5 0 0 1-1.46-.46L3.34 15.64a1.5 1.5 0 0 1-.2-1.5l.5-1.02A7.1 7.1 0 0 1 3.44 12c0-.55.07-1.08.2-1.6l-.5-1.01a1.5 1.5 0 0 1 .2-1.5l1.33-1.54a1.5 1.5 0 0 1 1.46-.45l1.1.27a7.06 7.06 0 0 1 1.56-.9l.56-.97Z"
                    fill="rgba(245,168,0,0.25)" stroke="var(--accent)" stroke-width="0.5" />
            </svg>
        </div>

        <h1>Under Maintenance</h1>
        <p>
            We're currently <strong>upgrading our systems</strong> to better serve you.
            Our team is working hard to get everything back online as soon as possible.<br /><br />
            We apologize for the inconvenience and appreciate your patience.
        </p>


        <div class="divider"></div>
        <div class="contact-label">Have questions?</div>

        <a href="mailto:ticketifyid@gmail.com" class="contact-btn">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            Contact Administrator
        </a>

        <div class="footer">
            <span>ticketify.id</span>
            <span id="ts"></span>
        </div>
    </div>

    <script>
        const el = document.getElementById('ts');
        const pad = n => String(n).padStart(2, '0');

        function tick() {
            const d = new Date();
            el.textContent =
                `${d.getFullYear()}-${pad(d.getMonth()+1)}-${pad(d.getDate())} ${pad(d.getHours())}:${pad(d.getMinutes())}:${pad(d.getSeconds())}`;
        }
        tick();
        setInterval(tick, 1000);
    </script>
</body>

</html>

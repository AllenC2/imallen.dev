<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Mis Proyectos — IMALLEN.DEV</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f5f5f7;
            --surface: #ffffff;
            --text: #1d1d1f;
            --text-secondary: #86868b;
            --text-tertiary: #aeaeb2;
            --accent: #f59e0b;
            --accent-soft: rgba(245, 158, 11, 0.12);
            --green: #34c759;
            --green-soft: rgba(52, 199, 89, 0.12);
            --red: #ff3b30;
            --red-soft: rgba(255, 59, 48, 0.10);
            --separator: rgba(60, 60, 67, 0.12);
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.04), 0 1px 2px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.06), 0 2px 6px rgba(0, 0, 0, 0.04);
            --shadow-lg: 0 12px 40px rgba(0, 0, 0, 0.10), 0 4px 12px rgba(0, 0, 0, 0.06);
            --radius-card: 22px;
            --radius-sm: 12px;
            --safe-top: env(safe-area-inset-top, 0px);
            --safe-bottom: env(safe-area-inset-bottom, 0px);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; -webkit-tap-highlight-color: transparent; }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            min-height: 100dvh;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
        }

        /* ── Navbar ── */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: calc(var(--safe-top) + 14px) 20px 14px;
            background: rgba(245, 245, 247, 0.72);
            backdrop-filter: saturate(180%) blur(20px);
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            border-bottom: 0.5px solid var(--separator);
        }

        .navbar-brand {
            font-size: 17px;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: var(--text);
        }
        .navbar-brand span { color: var(--accent); }

        .avatar-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: none;
            background: linear-gradient(135deg, var(--accent), #f97316);
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
            transition: transform 0.15s ease, box-shadow 0.15s ease;
            position: relative;
        }
        .avatar-btn:active { transform: scale(0.92); }

        /* Popover */
        .popover-overlay {
            position: fixed;
            inset: 0;
            background: transparent;
            z-index: 200;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
        }
        .popover-overlay.open { opacity: 1; pointer-events: auto; }

        .popover {
            position: fixed;
            top: calc(var(--safe-top) + 60px);
            right: 16px;
            width: 240px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: saturate(180%) blur(24px);
            -webkit-backdrop-filter: saturate(180%) blur(24px);
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            border: 0.5px solid rgba(0, 0, 0, 0.06);
            padding: 4px;
            z-index: 201;
            transform: scale(0.92) translateY(-8px);
            opacity: 0;
            pointer-events: none;
            transform-origin: top right;
            transition: transform 0.22s cubic-bezier(0.32, 0.72, 0, 1), opacity 0.18s ease;
        }
        .popover.open {
            transform: scale(1) translateY(0);
            opacity: 1;
            pointer-events: auto;
        }

        .popover-header {
            padding: 14px 16px 10px;
        }
        .popover-greeting {
            font-size: 12px;
            color: var(--text-tertiary);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 2px;
        }
        .popover-name {
            font-size: 17px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.01em;
        }
        .popover-divider {
            height: 0.5px;
            background: var(--separator);
            margin: 6px 8px;
        }
        .popover-logout {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 12px 16px;
            border: none;
            background: transparent;
            color: var(--red);
            font-size: 15px;
            font-weight: 500;
            font-family: inherit;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.12s ease;
        }
        .popover-logout:active { background: var(--red-soft); }
        .popover-logout svg { width: 18px; height: 18px; flex-shrink: 0; }

        /* ── Main ── */
        main {
            padding: 28px 20px calc(40px + var(--safe-bottom));
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 28px;
        }

        .page-greeting {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-tertiary);
            letter-spacing: 0.02em;
            margin-bottom: 4px;
        }
        .page-greeting-icon {
            font-size: 18px;
            line-height: 1;
        }

        .page-title {
            font-size: 38px;
            font-weight: 800;
            letter-spacing: -0.04em;
            line-height: 1.05;
            margin-bottom: 8px;
        }
        .page-title-greeting {
            display: block;
            background: linear-gradient(135deg, var(--text) 0%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
        }
        .page-title-name {
            display: block;
            font-size: 46px;
            font-weight: 800;
            letter-spacing: -0.04em;
            color: var(--text);
            -webkit-text-fill-color: var(--text);
        }

        .page-subtitle {
            font-size: 15px;
            color: var(--text-secondary);
            font-weight: 400;
            line-height: 1.45;
        }
        .page-subtitle strong {
            color: var(--text);
            font-weight: 700;
        }

        /* ── Cards ── */
        .cards-list {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
        }

        @media (min-width: 1024px) {
            .cards-list { grid-template-columns: repeat(2, 1fr); }
        }
        @media (min-width: 1440px) {
            .cards-list { grid-template-columns: repeat(3, 1fr); }
        }

        .card {
            display: block;
            text-decoration: none;
            color: inherit;
            background: var(--surface);
            border-radius: var(--radius-card);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            position: relative;
            transition: transform 0.18s cubic-bezier(0.32, 0.72, 0, 1), box-shadow 0.18s ease;
            opacity: 0;
            animation: cardIn 0.5s cubic-bezier(0.32, 0.72, 0, 1) forwards;
        }
        .card:active {
            transform: scale(0.975);
            box-shadow: var(--shadow-sm);
        }

        @keyframes cardIn {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card:nth-child(1) { animation-delay: 0.05s; }
        .card:nth-child(2) { animation-delay: 0.10s; }
        .card:nth-child(3) { animation-delay: 0.15s; }
        .card:nth-child(4) { animation-delay: 0.20s; }
        .card:nth-child(5) { animation-delay: 0.25s; }
        .card:nth-child(6) { animation-delay: 0.30s; }
        .card:nth-child(n+7) { animation-delay: 0.35s; }

        .card-cover {
            position: relative;
            width: 100%;
            aspect-ratio: 16 / 10;
            overflow: hidden;
            background: linear-gradient(135deg, #e8e8ed, #d1d1d6);
        }
        .card-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .card-cover-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #e8e8ed 0%, #d1d1d6 100%);
            color: var(--text-tertiary);
        }
        .card-cover-placeholder svg { width: 36px; height: 36px; opacity: 0.6; }

        .card-saldo-chip {
            position: absolute;
            top: 12px;
            right: 12px;
            padding: 5px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: -0.01em;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .card-saldo-chip.positive {
            background: rgba(52, 199, 89, 0.85);
            color: #fff;
        }
        .card-saldo-chip.negative {
            background: rgba(255, 59, 48, 0.88);
            color: #fff;
        }
        .card-saldo-chip.neutral {
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
        }
        .card-saldo-chip.no-cover.positive { background: var(--green-soft); color: var(--green); }
        .card-saldo-chip.no-cover.negative { background: var(--red-soft); color: var(--red); }
        .card-saldo-chip.no-cover.neutral { background: rgba(60, 60, 67, 0.08); color: var(--text-secondary); }

        .card-body {
            padding: 16px 18px 18px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--text);
            margin-bottom: 4px;
            line-height: 1.25;
        }

        .card-desc {
            font-size: 13.5px;
            color: var(--text-secondary);
            line-height: 1.45;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 0.5px solid var(--separator);
        }

        .card-meta {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: var(--text-tertiary);
            font-weight: 500;
        }
        .card-meta svg { width: 14px; height: 14px; }

        .card-chevron {
            color: var(--text-tertiary);
            display: flex;
            align-items: center;
        }
        .card-chevron svg { width: 16px; height: 16px; }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }
        .empty-state-icon {
            width: 72px;
            height: 72px;
            border-radius: 20px;
            background: var(--surface);
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: var(--text-tertiary);
        }
        .empty-state-icon svg { width: 32px; height: 32px; }
        .empty-state h3 {
            font-size: 19px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 8px;
            letter-spacing: -0.02em;
        }
        .empty-state p {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.45;
            max-width: 280px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="navbar-brand"><x-logo height="26" color="#f59e0b" /></div>
        <button class="avatar-btn" id="avatarBtn" aria-label="Menú de usuario">{{ strtoupper(substr($user->name, 0, 1)) }}</button>
    </nav>

    <div class="popover-overlay" id="popoverOverlay"></div>
    <div class="popover" id="popover">
        <div class="popover-header">
            <div class="popover-greeting">Hola</div>
            <div class="popover-name">{{ $user->name }}</div>
        </div>
        <div class="popover-divider"></div>
        <form method="POST" action="{{ route('logout') }}" style="width:100%;">
            @csrf
            <button type="submit" class="popover-logout">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Cerrar sesión
            </button>
        </form>
    </div>

    <main>
        <div class="page-header">
            @php
                $hora = (int) date('G');
                if ($hora < 6) { $saludo = 'Buenas noches'; $icono = '🌙'; }
                elseif ($hora < 12) { $saludo = 'Buenos días'; $icono = '☀️'; }
                elseif ($hora < 19) { $saludo = 'Buenas tardes'; $icono = '🌤'; }
                else { $saludo = 'Buenas noches'; $icono = '🌙'; }
                $fecha = \Carbon\Carbon::now()->locale('es')->isoFormat('dddd, D [de] MMMM');
            @endphp
            <div class="page-greeting"><span class="page-greeting-icon">{{ $icono }}</span> {{ $fecha }}</div>
            <h1 class="page-title">
                <span class="page-title-greeting">{{ $saludo }},</span>
                <span class="page-title-name">{{ $user->name }}</span>
            </h1>
            <p class="page-subtitle">Tienes <strong>{{ $expedientes->count() }} expediente{{ $expedientes->count() === 1 ? '' : 's' }}</strong> asignado{{ $expedientes->count() === 1 ? '' : 's' }} a tu cuenta.</p>
        </div>

        @if ($expedientes->isEmpty())
            <div class="empty-state" style="max-width:560px;margin:0 auto;">
                <div class="empty-state-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                    </svg>
                </div>
                <h3>Sin expedientes</h3>
                <p>Cuando se te asigne un expediente, aparecerá aquí.</p>
            </div>
        @else
            <div class="cards-list">
                @foreach ($expedientes as $expediente)
                    @php
                        $saldo = $expediente->saldo;
                        $sClass = $saldo > 0 ? 'positive' : ($saldo < 0 ? 'negative' : 'neutral');
                        $hasCover = !empty($expediente->cover_image);
                    @endphp
                    <a href="{{ route('portal.show', $expediente) }}" class="card">
                        <div class="card-cover">
                            @if ($hasCover)
                                <img src="{{ asset('storage/' . $expediente->cover_image) }}" alt="{{ $expediente->titulo }}">
                            @else
                                <div class="card-cover-placeholder">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                        <polyline points="14 2 14 8 20 8"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="card-saldo-chip {{ $sClass }}{{ !$hasCover ? ' no-cover' : '' }}">
                                @if ($saldo > 0)+@endif $ {{ number_format(abs($saldo), 2) }}
                            </div>
                        </div>
                        <div class="card-body">
                            <h2 class="card-title">{{ $expediente->titulo }}</h2>
                            @if ($expediente->descripcion)
                                <p class="card-desc">{{ $expediente->descripcion }}</p>
                            @endif
                            <div class="card-footer">
                                <div class="card-meta">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                                        <line x1="1" y1="10" x2="23" y2="10"/>
                                    </svg>
                                    {{ $expediente->movimientos->count() }} movimiento{{ $expediente->movimientos->count() === 1 ? '' : 's' }}
                                </div>
                                <div class="card-chevron">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="9 18 15 12 9 6"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </main>

    <script>
        const avatarBtn = document.getElementById('avatarBtn');
        const popover = document.getElementById('popover');
        const overlay = document.getElementById('popoverOverlay');

        function togglePopover(open) {
            const shouldOpen = open ?? !popover.classList.contains('open');
            popover.classList.toggle('open', shouldOpen);
            overlay.classList.toggle('open', shouldOpen);
        }

        avatarBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            togglePopover();
        });

        overlay.addEventListener('click', () => togglePopover(false));

        document.addEventListener('click', (e) => {
            if (!popover.contains(e.target) && !avatarBtn.contains(e.target)) {
                togglePopover(false);
            }
        });
    </script>
</body>

</html>
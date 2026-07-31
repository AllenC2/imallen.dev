<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>{{ $expediente->titulo }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f5f5f7;
            --surface: #ffffff;
            --surface-secondary: #f2f2f7;
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
        }
        .navbar-brand span { color: var(--accent); }

        .nav-actions { display: flex; align-items: center; gap: 10px; }

        .back-btn {
            display: flex;
            align-items: center;
            gap: 4px;
            border: none;
            background: transparent;
            color: var(--accent);
            font-size: 16px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            padding: 6px 8px 6px 4px;
            border-radius: 10px;
            transition: opacity 0.12s ease;
        }
        .back-btn:active { opacity: 0.6; }
        .back-btn svg { width: 20px; height: 20px; }

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
            transition: transform 0.15s ease;
            position: relative;
        }
        .avatar-btn:active { transform: scale(0.92); }

        /* Popover (same as index) */
        .popover-overlay {
            position: fixed; inset: 0; background: transparent; z-index: 200;
            opacity: 0; pointer-events: none; transition: opacity 0.2s ease;
        }
        .popover-overlay.open { opacity: 1; pointer-events: auto; }
        .popover {
            position: fixed; top: calc(var(--safe-top) + 60px); right: 16px;
            width: 240px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: saturate(180%) blur(24px);
            -webkit-backdrop-filter: saturate(180%) blur(24px);
            border-radius: 16px; box-shadow: var(--shadow-lg);
            border: 0.5px solid rgba(0, 0, 0, 0.06); padding: 4px; z-index: 201;
            transform: scale(0.92) translateY(-8px); opacity: 0; pointer-events: none;
            transform-origin: top right;
            transition: transform 0.22s cubic-bezier(0.32, 0.72, 0, 1), opacity 0.18s ease;
        }
        .popover.open { transform: scale(1) translateY(0); opacity: 1; pointer-events: auto; }
        .popover-header { padding: 14px 16px 10px; }
        .popover-greeting { font-size: 12px; color: var(--text-tertiary); font-weight: 500; text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 2px; }
        .popover-name { font-size: 17px; font-weight: 700; letter-spacing: -0.01em; }
        .popover-divider { height: 0.5px; background: var(--separator); margin: 6px 8px; }
        .popover-logout {
            display: flex; align-items: center; gap: 10px; width: 100%;
            padding: 12px 16px; border: none; background: transparent;
            color: var(--red); font-size: 15px; font-weight: 500; font-family: inherit;
            border-radius: 10px; cursor: pointer; transition: background 0.12s ease;
        }
        .popover-logout:active { background: var(--red-soft); }
        .popover-logout svg { width: 18px; height: 18px; flex-shrink: 0; }

        /* ── Main ── */
        main {
            max-width: 560px;
            margin: 0 auto;
            padding-bottom: calc(40px + var(--safe-bottom));
        }

        .hero-cover {
            width: 100%;
            aspect-ratio: 16 / 10;
            overflow: hidden;
            background: linear-gradient(135deg, #e8e8ed, #d1d1d6);
        }
        .hero-cover img { width: 100%; height: 100%; object-fit: cover; display: block; }

        .hero-content {
            padding: 24px 20px 0;
        }

        .hero-title {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1.15;
            margin-bottom: 8px;
        }

        .hero-desc {
            font-size: 15px;
            color: var(--text-secondary);
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .content-body {
            padding: 0 20px;
            font-size: 15px;
            line-height: 1.65;
            color: var(--text);
            margin-bottom: 24px;
        }
        .content-body h1, .content-body h2, .content-body h3 { font-weight: 700; letter-spacing: -0.02em; margin: 1.2em 0 0.5em; }
        .content-body p { margin-bottom: 0.8em; }
        .content-body ul, .content-body ol { padding-left: 1.3em; margin-bottom: 0.8em; }
        .content-body li { margin-bottom: 0.3em; }
        .content-body a { color: var(--accent); text-decoration: none; }
        .content-body img { max-width: 100%; border-radius: 12px; margin: 0.6em 0; }
        .content-body blockquote { border-left: 3px solid var(--accent); padding-left: 14px; color: var(--text-secondary); margin: 0.8em 0; }

        /* ── Saldo card ── */
        .saldo-section { padding: 0 20px; margin-bottom: 24px; }
        .saldo-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--surface);
            border-radius: var(--radius-card);
            padding: 20px 22px;
            box-shadow: var(--shadow-md);
            opacity: 0;
            animation: fadeUp 0.5s cubic-bezier(0.32, 0.72, 0, 1) 0.1s forwards;
        }
        .saldo-label {
            font-size: 13px;
            color: var(--text-secondary);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 4px;
        }
        .saldo-sub {
            font-size: 12px;
            color: var(--text-tertiary);
        }
        .saldo-value {
            font-size: 30px;
            font-weight: 800;
            letter-spacing: -0.03em;
        }
        .saldo-value.positive { color: var(--green); }
        .saldo-value.negative { color: var(--red); }
        .saldo-value.neutral { color: var(--text); }

        /* ── Pago card ── */
        .pago-section { padding: 0 20px; margin-bottom: 24px; }
        .pago-card {
            background: var(--surface);
            border-radius: var(--radius-card);
            padding: 22px;
            box-shadow: var(--shadow-md);
            opacity: 0;
            animation: fadeUp 0.5s cubic-bezier(0.32, 0.72, 0, 1) 0.15s forwards;
        }
        .pago-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }
        .pago-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: var(--accent-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .pago-icon svg { width: 22px; height: 22px; color: var(--accent); }
        .pago-title {
            font-size: 17px;
            font-weight: 700;
            letter-spacing: -0.02em;
        }
        .pago-desc {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.45;
            margin-bottom: 16px;
        }
        .pago-amount {
            display: flex;
            align-items: baseline;
            gap: 4px;
            margin-bottom: 18px;
        }
        .pago-amount-currency { font-size: 18px; font-weight: 600; color: var(--text-secondary); }
        .pago-amount-value { font-size: 36px; font-weight: 800; letter-spacing: -0.03em; color: var(--text); }
        .pago-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 15px;
            background: var(--text);
            color: #fff;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 700;
            font-family: inherit;
            text-decoration: none;
            cursor: pointer;
            transition: transform 0.15s ease, opacity 0.15s ease;
        }
        .pago-btn:active { transform: scale(0.97); opacity: 0.85; }
        .pago-btn svg { width: 18px; height: 18px; }

        /* ── Movimientos ── */
        .movimientos-section { padding: 0 20px; }
        .section-title {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.03em;
            margin-bottom: 14px;
        }
        .movimientos-list {
            background: var(--surface);
            border-radius: var(--radius-card);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            opacity: 0;
            animation: fadeUp 0.5s cubic-bezier(0.32, 0.72, 0, 1) 0.2s forwards;
        }
        .mov-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 20px;
            border-bottom: 0.5px solid var(--separator);
            cursor: pointer;
            transition: background 0.12s ease;
        }
        .mov-item:active { background: var(--surface-secondary); }
        .mov-item:last-child { border-bottom: none; }
        .mov-icon {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .mov-icon.pago { background: var(--green-soft); }
        .mov-icon.cargo { background: var(--red-soft); }
        .mov-icon svg { width: 18px; height: 18px; }
        .mov-icon.pago svg { color: var(--green); }
        .mov-icon.cargo svg { color: var(--red); }
        .mov-info { flex: 1; min-width: 0; }
        .mov-type {
            font-size: 15px;
            font-weight: 600;
            letter-spacing: -0.01em;
            margin-bottom: 2px;
        }
        .mov-desc {
            font-size: 13px;
            color: var(--text-secondary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .mov-right { text-align: right; flex-shrink: 0; }
        .mov-amount {
            font-size: 16px;
            font-weight: 700;
            letter-spacing: -0.01em;
            margin-bottom: 2px;
        }
        .mov-amount.pago { color: var(--green); }
        .mov-amount.cargo { color: var(--red); }
        .mov-date {
            font-size: 12px;
            color: var(--text-tertiary);
        }

        .empty-block {
            text-align: center;
            padding: 48px 20px;
            background: var(--surface);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-sm);
        }
        .empty-block p {
            font-size: 14px;
            color: var(--text-secondary);
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ── Modal ── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            z-index: 300;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s ease;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding: 0 16px calc(var(--safe-bottom) + 24px);
        }
        .modal-overlay.open { opacity: 1; pointer-events: auto; }

        .modal {
            width: 100%;
            max-width: 420px;
            background: var(--surface);
            border-radius: 28px 28px 22px 22px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            transform: translateY(100%);
            transition: transform 0.32s cubic-bezier(0.32, 0.72, 0, 1);
        }
        .modal-overlay.open .modal { transform: translateY(0); }

        .modal-handle {
            width: 36px;
            height: 5px;
            border-radius: 3px;
            background: var(--text-tertiary);
            margin: 10px auto 0;
            opacity: 0.5;
        }

        .modal-header {
            padding: 20px 24px 16px;
        }
        .modal-type-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }
        .modal-type-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .modal-type-icon.pago { background: var(--green-soft); }
        .modal-type-icon.cargo { background: var(--red-soft); }
        .modal-type-icon svg { width: 24px; height: 24px; }
        .modal-type-icon.pago svg { color: var(--green); }
        .modal-type-icon.cargo svg { color: var(--red); }
        .modal-type-label {
            font-size: 13px;
            color: var(--text-tertiary);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 2px;
        }
        .modal-type-name {
            font-size: 19px;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--text);
        }

        .modal-amount {
            text-align: center;
            margin-bottom: 20px;
        }
        .modal-amount-value {
            font-size: 44px;
            font-weight: 800;
            letter-spacing: -0.03em;
        }
        .modal-amount-value.pago { color: var(--green); }
        .modal-amount-value.cargo { color: var(--red); }

        .modal-divider {
            height: 0.5px;
            background: var(--separator);
            margin: 0 24px;
        }

        .modal-body {
            padding: 20px 24px 24px;
        }
        .modal-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            padding: 12px 0;
        }
        .modal-row + .modal-row { border-top: 0.5px solid var(--separator); }
        .modal-row-label {
            font-size: 14px;
            color: var(--text-secondary);
            font-weight: 500;
            flex-shrink: 0;
            padding-top: 1px;
        }
        .modal-row-value {
            font-size: 14px;
            color: var(--text);
            font-weight: 600;
            text-align: right;
            line-height: 1.5;
            white-space: pre-wrap;
            word-break: break-word;
            overflow-wrap: break-word;
            max-height: 240px;
            overflow-y: auto;
            flex: 1;
        }

        .modal-close {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 15px;
            background: var(--surface-secondary);
            color: var(--text);
            border: none;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            margin-top: 20px;
            transition: transform 0.15s ease;
        }
        .modal-close:active { transform: scale(0.97); }
    </style>
</head>

<body>
    <nav class="navbar">
        <a href="{{ route('portal.index') }}" class="back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
            Portal
        </a>
        <button class="avatar-btn" id="avatarBtn">{{ strtoupper(substr($user->name, 0, 1)) }}</button>
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
        @if ($expediente->cover_image)
            <div class="hero-cover">
                <img src="{{ asset('storage/' . $expediente->cover_image) }}" alt="{{ $expediente->titulo }}">
            </div>
        @endif

        <div class="hero-content">
            <h1 class="hero-title">{{ $expediente->titulo }}</h1>
            @if ($expediente->descripcion)
                <p class="hero-desc">{{ $expediente->descripcion }}</p>
            @endif
        </div>

        @if ($expediente->contenido)
            <div class="content-body">
                {!! $expediente->contenido !!}
            </div>
        @endif

        @php
            $saldo = $expediente->saldo;
            $saldoClass = $saldo > 0 ? 'positive' : ($saldo < 0 ? 'negative' : 'neutral');
        @endphp
        <div class="saldo-section">
            <div class="saldo-card">
                <div>
                    <div class="saldo-label">Saldo</div>
                    <div class="saldo-sub">{{ $expediente->movimientos->count() }} movimiento{{ $expediente->movimientos->count() === 1 ? '' : 's' }}</div>
                </div>
                <div class="saldo-value {{ $saldoClass }}">
                    @if ($saldo > 0)+@endif $ {{ number_format(abs($saldo), 2) }}
                </div>
            </div>
        </div>

        @if ($expediente->enlace_opcion_pago)
            <div class="pago-section">
                <div class="pago-card">
                    <div class="pago-header">
                        <div class="pago-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                                <line x1="1" y1="10" x2="23" y2="10"/>
                            </svg>
                        </div>
                        <h3 class="pago-title">{{ $expediente->titulo_opcion_pago ?? 'Pagar' }}</h3>
                    </div>
                    @if ($expediente->descripcion_opcion_pago)
                        <p class="pago-desc">{{ $expediente->descripcion_opcion_pago }}</p>
                    @endif
                    @if ($expediente->cantidad_opcion_pago)
                        <div class="pago-amount">
                            <span class="pago-amount-currency">$</span>
                            <span class="pago-amount-value">{{ number_format($expediente->cantidad_opcion_pago, 2) }}</span>
                        </div>
                    @endif
                    <a href="{{ $expediente->enlace_opcion_pago }}" target="_blank" rel="noopener noreferrer" class="pago-btn">
                        Pagar ahora
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </a>
                </div>
            </div>
        @endif

        <div class="movimientos-section">
            <h2 class="section-title">Movimientos</h2>
            @if ($expediente->movimientos->isEmpty())
                <div class="empty-block">
                    <p>No hay movimientos registrados.</p>
                </div>
            @else
                <div class="movimientos-list">
                    @foreach ($expediente->movimientos as $mov)
                        @php $isPago = $mov->tipo->value === 'Pago'; @endphp
                        <div class="mov-item"
                             data-tipo="{{ $mov->tipo->value }}"
                             data-nombre="{{ $isPago ? 'Pago recibido' : 'Cargo aplicado' }}"
                             data-monto="{{ number_format($mov->monto, 2) }}"
                             data-fecha="{{ $mov->fecha->format('d/m/Y') }}"
                             data-descripcion="{{ $mov->descripcion ?? '' }}"
                             data-creado="{{ $mov->created_at->format('d/m/Y H:i') }}">
                            <div class="mov-icon {{ $isPago ? 'pago' : 'cargo' }}">
                                @if ($isPago)
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="6 9 12 15 18 9" transform="rotate(180 12 12)"/>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="6 9 12 15 18 9"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="mov-info">
                                <div class="mov-type">{{ $mov->tipo->value }}</div>
                                <div class="mov-desc">{{ $mov->descripcion ?? 'Sin descripción' }}</div>
                            </div>
                            <div class="mov-right">
                                <div class="mov-amount {{ $isPago ? 'pago' : 'cargo' }}">
                                    {{ $isPago ? '+' : '-' }} $ {{ number_format($mov->monto, 2) }}
                                </div>
                                <div class="mov-date">{{ $mov->fecha->format('d/m/Y') }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>

    <!-- Movimiento Modal -->
    <div class="modal-overlay" id="movModal">
        <div class="modal">
            <div class="modal-handle"></div>
            <div class="modal-header">
                <div class="modal-type-row">
                    <div class="modal-type-icon pago" id="movModalTypeIcon"></div>
                    <div>
                        <div class="modal-type-label">Movimiento</div>
                        <div class="modal-type-name" id="movModalTypeName">—</div>
                    </div>
                </div>
                <div class="modal-amount">
                    <div class="modal-amount-value pago" id="movModalAmount">—</div>
                </div>
            </div>
            <div class="modal-divider"></div>
            <div class="modal-body">
                <div class="modal-row">
                    <span class="modal-row-label">Fecha</span>
                    <span class="modal-row-value" id="movModalFecha">—</span>
                </div>
                <div class="modal-row">
                    <span class="modal-row-label">Descripción</span>
                    <span class="modal-row-value" id="movModalDesc">—</span>
                </div>
                <div class="modal-row">
                    <span class="modal-row-label">Registrado</span>
                    <span class="modal-row-value" id="movModalCreado">—</span>
                </div>
                <button class="modal-close" onclick="closeMovModal()">Cerrar</button>
            </div>
        </div>
    </div>

    <script>
        const avatarBtn = document.getElementById('avatarBtn');
        const popover = document.getElementById('popover');
        const overlay = document.getElementById('popoverOverlay');

        function togglePopover(open) {
            const shouldOpen = open ?? !popover.classList.contains('open');
            popover.classList.toggle('open', shouldOpen);
            overlay.classList.toggle('open', shouldOpen);
        }
        avatarBtn.addEventListener('click', (e) => { e.stopPropagation(); togglePopover(); });
        overlay.addEventListener('click', () => togglePopover(false));
        document.addEventListener('click', (e) => {
            if (!popover.contains(e.target) && !avatarBtn.contains(e.target)) togglePopover(false);
        });

        // ── Movimiento modal ──
        const movModal = document.getElementById('movModal');

        document.querySelectorAll('.mov-item').forEach(function(item) {
            item.addEventListener('click', function() {
                const tipo = this.dataset.tipo;
                const nombre = this.dataset.nombre;
                const monto = this.dataset.monto;
                const fecha = this.dataset.fecha;
                const descripcion = this.dataset.descripcion;
                const creado = this.dataset.creado;

                const isPago = tipo === 'Pago';
                const typeClass = isPago ? 'pago' : 'cargo';
                const prefix = isPago ? '+' : '-';
                const desc = descripcion && descripcion.trim() !== '' ? descripcion : 'Sin descripción';

                const iconEl = document.getElementById('movModalTypeIcon');
                iconEl.className = 'modal-type-icon ' + typeClass;
                iconEl.innerHTML = isPago
                    ? '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9" transform="rotate(180 12 12)"/></svg>'
                    : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>';
                document.getElementById('movModalTypeName').textContent = nombre;
                document.getElementById('movModalAmount').className = 'modal-amount-value ' + typeClass;
                document.getElementById('movModalAmount').textContent = prefix + ' $ ' + monto;
                document.getElementById('movModalFecha').textContent = fecha;
                document.getElementById('movModalDesc').textContent = desc;
                document.getElementById('movModalCreado').textContent = creado;

                movModal.classList.add('open');
            });
        });

        function closeMovModal() { movModal.classList.remove('open'); }
        movModal.addEventListener('click', (e) => { if (e.target === movModal) closeMovModal(); });
    </script>
</body>

</html>
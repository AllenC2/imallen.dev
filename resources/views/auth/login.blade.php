<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Iniciar sesión</title>
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
            --red: #ff3b30;
            --red-soft: rgba(255, 59, 48, 0.10);
            --separator: rgba(60, 60, 67, 0.12);
            --shadow-lg: 0 12px 40px rgba(0, 0, 0, 0.10), 0 4px 12px rgba(0, 0, 0, 0.06);
            --safe-top: env(safe-area-inset-top, 0px);
            --safe-bottom: env(safe-area-inset-bottom, 0px);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; -webkit-tap-highlight-color: transparent; }
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            min-height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg);
            color: var(--text);
            padding: calc(var(--safe-top) + 24px) 20px calc(var(--safe-bottom) + 24px);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .card {
            width: 100%;
            max-width: 400px;
            background: var(--surface);
            border-radius: 28px;
            padding: 40px 32px 32px;
            box-shadow: var(--shadow-lg);
            opacity: 0;
            animation: cardIn 0.55s cubic-bezier(0.32, 0.72, 0, 1) 0.05s forwards;
        }
        @keyframes cardIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .brand {
            text-align: center;
            margin-bottom: 32px;
        }
        .brand-logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--accent), #f97316);
            box-shadow: 0 4px 14px rgba(245, 158, 11, 0.3);
            margin-bottom: 16px;
        }
        .brand-logo svg { width: 28px; height: 28px; }
        .brand-name {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--text);
        }
        .brand-name span { color: var(--accent); }

        .field-group {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 20px;
        }
        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .field label {
            font-size: 13px;
            color: var(--text-secondary);
            font-weight: 600;
            margin-left: 4px;
        }
        .input-wrap {
            position: relative;
        }
        .input-wrap svg {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            color: var(--text-tertiary);
            pointer-events: none;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 15px 16px 15px 46px;
            background: #f2f2f7;
            border: 1.5px solid transparent;
            border-radius: 14px;
            color: var(--text);
            font-family: inherit;
            font-size: 16px;
            font-weight: 500;
            transition: border-color 0.15s ease, background 0.15s ease;
            outline: none;
        }
        input::placeholder { color: var(--text-tertiary); }
        input:focus {
            background: var(--surface);
            border-color: var(--accent);
        }
        input.field-error {
            border-color: var(--red);
            background: var(--red-soft);
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
            margin-left: 4px;
        }
        .remember input {
            appearance: none;
            -webkit-appearance: none;
            width: 22px;
            height: 22px;
            border-radius: 7px;
            border: 1.5px solid var(--text-tertiary);
            cursor: pointer;
            position: relative;
            transition: background 0.15s ease, border-color 0.15s ease;
        }
        .remember input:checked {
            background: var(--accent);
            border-color: var(--accent);
        }
        .remember input:checked::after {
            content: '';
            position: absolute;
            top: 4px;
            left: 7px;
            width: 5px;
            height: 9px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
        .remember label {
            font-size: 14px;
            color: var(--text-secondary);
            font-weight: 500;
            cursor: pointer;
        }

        .submit-btn {
            width: 100%;
            padding: 16px;
            background: var(--text);
            color: #fff;
            border: none;
            border-radius: 14px;
            font-family: inherit;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.15s ease, opacity 0.15s ease;
            -webkit-appearance: none;
        }
        .submit-btn:active { transform: scale(0.97); opacity: 0.85; }

        .error-banner {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--red-soft);
            border-radius: 14px;
            padding: 14px 16px;
            margin-bottom: 20px;
            font-size: 14px;
            color: var(--red);
            font-weight: 500;
            line-height: 1.4;
        }
        .error-banner svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        .home-link {
            text-align: center;
            margin-top: 24px;
        }
        .home-link a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--accent);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: opacity 0.12s ease;
        }
        .home-link a:active { opacity: 0.6; }
        .home-link svg { width: 16px; height: 16px; }
    </style>
</head>

<body>
    <div class="card">
        <div class="brand">
            <x-logo height="34" color="#f59e0b" />
        </div>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="error-banner">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="8" x2="12" y2="12"/>
                            <line x1="12" y1="16" x2="12.01" y2="16"/>
                        </svg>
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            <div class="field-group">
                <div class="field">
                    <label for="email">Email</label>
                    <div class="input-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                        <input type="email" id="email" name="email"
                               value="{{ old('email') }}"
                               placeholder="tu@email.com"
                               class="{{ $errors->has('email') ? 'field-error' : '' }}"
                               required autofocus>
                    </div>
                </div>
                <div class="field">
                    <label for="password">Contraseña</label>
                    <div class="input-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        <input type="password" id="password" name="password"
                               placeholder="••••••••"
                               class="{{ $errors->has('password') ? 'field-error' : '' }}"
                               required>
                    </div>
                </div>
            </div>

            <div class="remember">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Recuérdame</label>
            </div>

            <button type="submit" class="submit-btn">Entrar</button>
        </form>

        <div class="home-link">
            <a href="{{ route('home') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
                Volver al inicio
            </a>
        </div>
    </div>
</body>

</html>
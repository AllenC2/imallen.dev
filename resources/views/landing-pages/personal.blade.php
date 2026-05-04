<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-gtm-head />
    <meta name="description"
        content="{{ $landingPage->meta_description ?? 'Portafolio y servicios de desarrollo enfocado en la calidad web.' }}">
    <title>{{ $landingPage->meta_title ?? ($landingPage->title ?? 'Hola, soy Desarrollador Web') }}</title>
    <!-- Modern typography for premium feel -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/0.160.0/three.min.js"></script>
    <style>
        .hero-personal-bg {
            max-width: 100% !important;
            margin: 0 !important;
            padding: 0 max(5vw, calc(50vw - 630px)) !important;
            background-image:
                url('/storage/images/herop-sujeto.png'),
                url('/storage/images/herop-fondo.png');
            background-size:
                auto 95%,
                /* El sujeto casi cubre el alto */
                cover;
            /* El fondo cubre todo */
            background-position:
                calc(100% + 250px) bottom,
                /* El sujeto alineado a la derecha, apoyado abajo */
                center center;
            /* Fondo centrado */
            background-repeat: no-repeat, no-repeat;
            position: relative;
        }

        .hero-personal-bg::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 150px;
            background: linear-gradient(to top, var(--bg-color), transparent);
            z-index: 1;
        }

        .hero-personal-bg .hero-content {
            z-index: 2;
            max-width: 60%;
        }

        /* Ajustes responsivos para que en móvil el sujeto no tape el texto principal */
        @media (max-width: 1024px) {
            .hero-personal-bg {
                background-size:
                    85% auto,
                    cover;
                background-position:
                    center bottom,
                    center center;
            }

            .hero-personal-bg .hero-content {
                max-width: 100%;
                z-index: 10;
                background: rgba(2, 4, 10, 0.4);
                /* Leve sombra en móvil para asegurar legibilidad */
                padding: 2rem;
                border-radius: 20px;
                backdrop-filter: blur(5px);
            }
        }

        /* Mini Carousel after subtitle */
        .hero-mini-carousel {
            margin: 0.5rem 0 1.5rem 0;
            width: 60%;
            overflow: hidden;
            position: relative;
            padding: 10px 0;
            -webkit-mask-image: linear-gradient(to right, transparent, black 15%, black 85%, transparent);
            mask-image: linear-gradient(to right, transparent, black 15%, black 85%, transparent);
        }


        .carousel-track-mini {
            display: flex;
            gap: 12px;
            animation: scroll-mini 30s linear infinite;
            width: max-content;
        }

        .carousel-track-mini:hover {
            animation-play-state: paused;
        }

        .carousel-item-mini {
            width: 110px;
            height: 70px;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .carousel-item-mini img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .carousel-item-mini:hover {
            transform: translateY(-5px) scale(1.05);
            border-color: var(--accent);
        }

        .carousel-item-mini:hover img {
            transform: scale(1.1);
        }

        .carousel-item-mini .service-text-overlay p {
            font-size: 1.2rem;
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 2rem;
            max-width: 90%;
            margin-left: auto;
            margin-right: auto;
        }

        .service-cta {
            display: inline-block;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            background: var(--item-color, var(--accent));
            color: white;
            box-shadow: 0 0 20px var(--item-glow, rgba(139, 92, 246, 0.3));
            border: none;
            cursor: pointer;
        }

        .service-cta:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 30px var(--item-color, var(--accent));
            color: white;
        }

        .carousel-item-mini .item-label {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 5px 8px;
            font-size: 0.65rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        @keyframes scroll-mini {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(calc(-110px * 7 - 12px * 7));
            }
        }

        @media (max-width: 1024px) {
            .hero-mini-carousel {
                margin: 2rem auto;
                max-width: 90%;
            }
        }

        .hero-corner-img {
            position: absolute;
            top: -50px;
            left: -30px;
            width: 100px;
            height: auto;
            z-index: 5;
            filter: drop-shadow(0 0 15px rgba(255, 255, 255, 0.2));
            animation: drondji-float 3s ease-in-out infinite alternate;
            pointer-events: none;
        }

        @keyframes drondji-float {
            0% {
                transform: translateY(0) rotate(-5deg);
            }

            100% {
                transform: translateY(-10px) rotate(5deg);
            }
        }

        @media (max-width: 768px) {
            .hero-corner-img {
                width: 70px;
                top: -40px;
                left: 0;
            }
        }

        .cta-button.secondary-glass[href="#contacto"]:hover {
            box-shadow: 0 0 30px rgba(249, 115, 22, 0.6) !important;
            border-color: rgba(249, 115, 22, 0.8) !important;
            background: rgba(249, 115, 22, 0.1) !important;
        }

        /* Flatpickr Custom Overrides */
        .flatpickr-calendar.dark {
            background: rgba(0, 0, 0, 0.98);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.9);
        }
        .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange, .flatpickr-day.selected.inRange, .flatpickr-day.startRange.inRange, .flatpickr-day.endRange.inRange, .flatpickr-day.selected:focus, .flatpickr-day.startRange:focus, .flatpickr-day.endRange:focus, .flatpickr-day.selected:hover, .flatpickr-day.startRange:hover, .flatpickr-day.endRange:hover, .flatpickr-day.selected.prevMonthDay, .flatpickr-day.startRange.prevMonthDay, .flatpickr-day.endRange.prevMonthDay, .flatpickr-day.selected.nextMonthDay, .flatpickr-day.startRange.nextMonthDay, .flatpickr-day.endRange.nextMonthDay {
            background: #f97316;
            border-color: #f97316;
        }
        .flatpickr-months .flatpickr-prev-month:hover svg, .flatpickr-months .flatpickr-next-month:hover svg {
            fill: #f97316;
        }
        .flatpickr-time {
            padding: 1.5rem 1.5rem !important;
            max-height: none !important;
            height: auto !important;
        }
        .flatpickr-time input:hover, .flatpickr-time .flatpickr-am-pm:hover, .flatpickr-time input:focus, .flatpickr-time .flatpickr-am-pm:focus {
            background: rgba(249, 115, 22, 0.2);
        }
    </style>

</head>

<body>
    <x-gtm-body />

    <!-- Header -->
    <header id="main-header"
        style="padding: 1.2rem 5%; width: 100%; position: fixed; top: 0; left: 0; right: 0; z-index: 1000; display: flex; justify-content: center; align-items: center; transition: all 0.3s ease;">
        <div style="width: 100%; max-width: 1400px; display: flex; justify-content: space-between; align-items: center;">
            <a href="/">
                <!-- Inline SVG Logo -->
                <svg style="height: 30px;" viewBox="0 0 380 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M5.14258 19.0713H13.4404V63.0713H0V0.959961H8.9375L5.14258 19.0713ZM36.3496 0C41.0216 0 44.35 1.53542 46.334 4.60742C48.19 1.53562 51.5176 6.26624e-05 56.3174 0H63.4219C71.3577 7.03886e-05 75.3262 4.22395 75.3262 12.6719V63.0713H61.8857V11.5195C61.8857 11.0076 61.6935 10.5598 61.3096 10.1758C60.9896 9.79178 60.5735 9.59961 60.0615 9.59961H54.8779C54.3659 9.59961 53.9172 9.79178 53.5332 10.1758C53.2134 10.5597 53.0537 11.0077 53.0537 11.5195V63.0713H39.6133V11.5195C39.6133 11.0077 39.4219 10.5597 39.0381 10.1758C38.7182 9.79187 38.3019 9.5997 37.79 9.59961H32.6055C32.0936 9.59966 31.6457 9.79183 31.2617 10.1758C30.9418 10.5597 30.7812 11.0076 30.7812 11.5195V63.0713H17.3418V12.6719C17.3418 4.22388 21.3101 0 29.2461 0H36.3496ZM106.234 0C114.17 0 118.139 4.22388 118.139 12.6719V63.0713H104.698V42.2393H95.0029V63.0713H81.5625V12.6719C81.5625 4.22388 85.5308 0 93.4668 0H106.234ZM137.597 51.7432H152.284V63.0713H124.156V0.959961H137.597V51.7432ZM171.097 51.7432H185.784V63.0713H157.656V0.959961H171.097V51.7432ZM218.477 11.9033H203.597V26.4951H217.517V37.0557H203.597V51.9355H218.477V63.0713H190.156V0.959961H218.477V11.9033ZM247.962 0C255.898 0 259.866 4.22388 259.866 12.6719V50.293C258.69 50.5934 257.645 51.1999 256.731 52.1133C255.371 53.4743 254.69 55.127 254.69 57.0713C254.69 59.0156 255.371 60.6683 256.731 62.0293C257.141 62.4384 257.577 62.7851 258.039 63.0713H246.426V11.5195C246.426 11.0077 246.234 10.5597 245.851 10.1758C245.531 9.79187 245.114 9.5997 244.603 9.59961H239.418C238.906 9.59966 238.458 9.79183 238.074 10.1758C237.754 10.5597 237.594 11.0076 237.594 11.5195V63.0713H224.154V12.6719C224.154 4.22388 228.123 0 236.059 0H247.962ZM333.83 11.9033H318.95V26.4951H332.87V37.0557H318.95V51.9355H343.83L345.83 63.0713H305.51V0.959961H333.83V11.9033ZM359.076 46.2715L366.66 0.959961H379.62L366.756 63.0713H351.3L338.436 0.959961H351.492L359.076 46.2715ZM288.588 0.959961C296.524 0.959961 300.492 5.18384 300.492 13.6318V50.3994C300.492 58.8474 296.524 63.0713 288.588 63.0713H265.342C265.803 62.7852 266.239 62.4383 266.648 62.0293C268.009 60.6682 268.69 59.0157 268.69 57.0713C268.69 55.1269 268.009 53.4744 266.648 52.1133C265.841 51.3054 264.929 50.7385 263.916 50.4102V0.959961H288.588ZM277.356 53.8555H285.229C285.74 53.8554 286.157 53.6632 286.477 53.2793C286.86 52.8954 287.052 52.4474 287.052 51.9355V11.999C287.052 11.4872 286.86 11.0391 286.477 10.6553C286.157 10.2713 285.74 10.0792 285.229 10.0791H277.356V53.8555ZM96.8271 9.11914C96.3151 9.11914 95.8664 9.31131 95.4824 9.69531C95.1625 10.0792 95.003 10.5273 95.0029 11.0391V31.8711H104.698V11.0391C104.698 10.5273 104.507 10.0792 104.123 9.69531C103.803 9.31139 103.387 9.11922 102.875 9.11914H96.8271Z"
                        fill="white" />
                </svg>
            </a>
            <a href="#contacto" class="cta-button secondary-glass" style="padding: 0.8rem 3.5rem; font-size: 1rem; border-color: rgba(249, 115, 22, 0.4) !important; box-shadow: 0 0 20px rgba(249, 115, 22, 0.3);">Agendar</a>
        </div>
    </header>

    <section class="hero hero-personal-bg">
        <div class="hero-content" style="position: relative;">
            <img src="/storage/images/drondji.webp" alt="Drondji" class="hero-corner-img">
            <h1 class="hero-title">Ingeniero de Software</br>y Arquitecto Digital.</h1>
            <p class="hero-subtitle" style="color:white;">
                Me dedico al software y el análisis de datos para crear sistemas completos
                (Web, eCommerce y Chatbots) que no solo se ven bien, sino que
                funcionan con precisión matemática.
            </p>

            <div class="hero-mini-carousel">
                <div class="carousel-track-mini">
                    <!-- Projects from storage/projects -->
                    <a href="#servicios" class="carousel-item-mini">
                        <img src="/storage/projects/c&c_showcase.png" alt="C&C">
                        <div class="item-label">C&C</div>
                    </a>
                    <a href="#servicios" class="carousel-item-mini">
                        <img src="/storage/projects/cedi_showcase.png" alt="CEDI">
                        <div class="item-label">CEDI</div>
                    </a>
                    <a href="#servicios" class="carousel-item-mini">
                        <img src="/storage/projects/conhum_showcase.png" alt="Conhum">
                        <div class="item-label">Conhum</div>
                    </a>
                    <a href="#servicios" class="carousel-item-mini">
                        <img src="/storage/projects/dg_showcase.png" alt="DG">
                        <div class="item-label">DG</div>
                    </a>
                    <a href="#servicios" class="carousel-item-mini">
                        <img src="/storage/projects/malinalli_showcase.png" alt="Malinalli">
                        <div class="item-label">Malinalli</div>
                    </a>
                    <a href="#servicios" class="carousel-item-mini">
                        <img src="/storage/projects/spromo_showcase.png" alt="Spromo">
                        <div class="item-label">Spromo</div>
                    </a>
                    <a href="#servicios" class="carousel-item-mini">
                        <img src="/storage/projects/starmex_showcase.png" alt="Starmex">
                        <div class="item-label">Starmex</div>
                    </a>
                    <!-- Duplicate for infinite scroll -->
                    <a href="#servicios" class="carousel-item-mini">
                        <img src="/storage/projects/c&c_showcase.png" alt="C&C">
                        <div class="item-label">C&C</div>
                    </a>
                    <a href="#servicios" class="carousel-item-mini">
                        <img src="/storage/projects/cedi_showcase.png" alt="CEDI">
                        <div class="item-label">CEDI</div>
                    </a>
                    <a href="#servicios" class="carousel-item-mini">
                        <img src="/storage/projects/conhum_showcase.png" alt="Conhum">
                        <div class="item-label">Conhum</div>
                    </a>
                    <a href="#servicios" class="carousel-item-mini">
                        <img src="/storage/projects/dg_showcase.png" alt="DG">
                        <div class="item-label">DG</div>
                    </a>
                    <a href="#servicios" class="carousel-item-mini">
                        <img src="/storage/projects/malinalli_showcase.png" alt="Malinalli">
                        <div class="item-label">Malinalli</div>
                    </a>
                    <a href="#servicios" class="carousel-item-mini">
                        <img src="/storage/projects/spromo_showcase.png" alt="Spromo">
                        <div class="item-label">Spromo</div>
                    </a>
                    <a href="#servicios" class="carousel-item-mini">
                        <img src="/storage/projects/starmex_showcase.png" alt="Starmex">
                        <div class="item-label">Starmex</div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="servicios" class="services section-padding">
        <div class="sphere-bg-glow" id="sphere-glow"></div>
        <div class="service-3d-wrapper" id="sphere-container"></div>
        <div class="container">
            <div class="section-title text-center">
                <h2>Mis <span>Servicios</span></h2>
                <p>Todos mis desarrollos cumplen con lo que hoy en dia deberian ser el estandar de la web moderna,
                    enfocados en ayudarte a escalar.</p>
            </div>
            <div class="services-interactive-container">
                @php
                    $hardcodedServices = [
                        [
                            'title' => 'Sistemas, Aplicaciones y Plataformas Web',
                            'description' => 'Diseño y programo las soluciones a todo tipo de problematicas digitales que todo proyecto o negocio suele enfrentar, desde problemas de organización interna, hasta la automatización de procesos.',
                            'icon' => 'fa-solid fa-layer-group',
                            'button_text' => 'Me interesa',
                            'svg_pos' => 'top: -20px; right: -30px; transform: rotate(15deg);'
                        ],
                        [
                            'title' => 'Sitios de eCommerce y Marketing de Datos',
                            'description' => 'Impulsa tus ventas con tiendas online optimizadas y estrategias basadas en el análisis profundo de datos.',
                            'icon' => 'fa-solid fa-chart-line',
                            'button_text' => 'Ver estrategias',
                            'svg_pos' => 'top: -10px; left: -40px; transform: rotate(-10deg);'
                        ],
                        [
                            'title' => 'Atención al Cliente 100% Automatizada con IA',
                            'description' => 'Automatización inteligente de canales de comunicación para brindar soporte 24/7 con lenguaje natural.',
                            'icon' => 'fa-solid fa-robot',
                            'button_text' => 'Probar IA',
                            'svg_pos' => 'bottom: -20px; right: -20px; transform: rotate(5deg);'
                        ]
                    ];
                    $featuredServices = collect($hardcodedServices)->map(fn($s) => (object) $s);
                    $firstService = $featuredServices->first();

                    $themes = [
                        ['c1' => [0.97, 0.45, 0.08], 'c2' => [0.98, 0.75, 0.14], 'scale' => 2.0, 'speed' => 0.4, 'hex' => '#f97316'], // Citrus Orange
                        ['c1' => [0.54, 0.36, 0.96], 'c2' => [0.85, 0.27, 0.93], 'scale' => 3.5, 'speed' => 0.2, 'hex' => '#8b5cf6'], // Purple
                        ['c1' => [0.96, 0.96, 0.95], 'c2' => [0.90, 0.90, 0.88], 'scale' => 1.5, 'speed' => 0.15, 'hex' => '#f5f5f4'], // Bone White
                    ];
                @endphp
                @if($firstService)
                    <!-- Selection List (Left now) -->
                    <div class="service-selection-list">
                        @foreach($featuredServices as $index => $service)
                            @php $theme = $themes[$index] ?? $themes[0]; @endphp
                            <div class="selection-item {{ $index === 0 ? 'active' : '' }}"
                                style="--item-color: {{ $theme['hex'] }}; --item-glow: {{ $theme['hex'] }}44;"
                                data-title="{{ $service->title }}" data-description="{{ $service->description }}"
                                data-icon="{{ $service->icon ?? 'fa-solid fa-code' }}"
                                data-btn-text="{{ $service->button_text ?? 'Saber más' }}"
                                data-svg-pos="{{ $service->svg_pos }}" data-c1="{{ json_encode($theme['c1']) }}"
                                data-c2="{{ json_encode($theme['c2']) }}" data-scale="{{ $theme['scale'] }}"
                                data-speed="{{ $theme['speed'] }}" data-hex="{{ $theme['hex'] }}">
                                <i class="{{ $service->icon ?? 'fa-solid fa-code' }}"></i>
                                <span>{{ $service->title }}</span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Detail Card (Right now) -->
                    <div class="service-detail-card glass-card" id="service-detail">
                        <div class="service-text-overlay" id="service-overlay">
                            <div class="detail-header">
                                <div class="floating-svg" id="detail-svg" style="{{ $firstService->svg_pos }}">
                                    <svg viewBox="0 0 380 64" fill="currentColor">
                                        <path
                                            d="M5.14258 19.0713H13.4404V63.0713H0V0.959961H8.9375L5.14258 19.0713ZM36.3496 0C41.0216 0 44.35 1.53542 46.334 4.60742C48.19 1.53562 51.5176 6.26624e-05 56.3174 0H63.4219C71.3577 7.03886e-05 75.3262 4.22395 75.3262 12.6719V63.0713H61.8857V11.5195C61.8857 11.0076 61.6935 10.5598 61.3096 10.1758C60.9896 9.79178 60.5735 9.59961 60.0615 9.59961H54.8779C54.3659 9.59961 53.9172 9.79178 53.5332 10.1758C53.2134 10.5597 53.0537 11.0077 53.0537 11.5195V63.0713H39.6133V11.5195C39.6133 11.0077 39.4219 10.5597 39.0381 10.1758C38.7182 9.79187 38.3019 9.5997 37.79 9.59961H32.6055C32.0936 9.59966 31.6457 9.79183 31.2617 10.1758C30.9418 10.5597 30.7812 11.0076 30.7812 11.5195V63.0713H17.3418V12.6719C17.3418 4.22388 21.3101 0 29.2461 0H36.3496ZM106.234 0C114.17 0 118.139 4.22388 118.139 12.6719V63.0713H104.698V42.2393H95.0029V63.0713H81.5625V12.6719C81.5625 4.22388 85.5308 0 93.4668 0H106.234ZM137.597 51.7432H152.284V63.0713H124.156V0.959961H137.597V51.7432ZM171.097 51.7432H185.784V63.0713H157.656V0.959961H171.097V51.7432ZM218.477 11.9033H203.597V26.4951H217.517V37.0557H203.597V51.9355H218.477V63.0713H190.156V0.959961H218.477V11.9033ZM247.962 0C255.898 0 259.866 4.22388 259.866 12.6719V50.293C258.69 50.5934 257.645 51.1999 256.731 52.1133C255.371 53.4743 254.69 55.127 254.69 57.0713C254.69 59.0156 255.371 60.6683 256.731 62.0293C257.141 62.4384 257.577 62.7851 258.039 63.0713H246.426V11.5195C246.426 11.0077 246.234 10.5597 245.851 10.1758C245.531 9.79187 245.114 9.5997 244.603 9.59961H239.418C238.906 9.59966 238.458 9.79183 238.074 10.1758C237.754 10.5597 237.594 11.0076 237.594 11.5195V63.0713H224.154V12.6719C224.154 4.22388 228.123 0 236.059 0H247.962ZM333.83 11.9033H318.95V26.4951H332.87V37.0557H318.95V51.9355H343.83L345.83 63.0713H305.51V0.959961H333.83V11.9033ZM359.076 46.2715L366.66 0.959961H379.62L366.756 63.0713H351.3L338.436 0.959961H351.492L359.076 46.2715ZM288.588 0.959961C296.524 0.959961 300.492 5.18384 300.492 13.6318V50.3994C300.492 58.8474 296.524 63.0713H288.588V63.0713H265.342C265.803 62.7852 266.239 62.4383 266.648 62.0293C268.009 60.6682 268.69 59.0157 268.69 57.0713C268.69 55.1269 268.009 53.4744 266.648 52.1133C265.841 51.3054 264.929 50.7385 263.916 50.4102V0.959961H288.588ZM277.356 53.8555H285.229C285.74 53.8554 286.157 53.6632 286.477 53.2793C286.86 52.8954 287.052 52.4474 287.052 51.9355V11.999C287.052 11.4872 286.86 11.0391 286.477 10.6553C286.157 10.2713 285.74 10.0792 285.229 10.0791H277.356V53.8555ZM96.8271 9.11914C96.3151 9.11914 95.8664 9.31131 95.4824 9.69531C95.1625 10.0792 95.003 10.5273 95.0029 11.0391V31.8711H104.698V11.0391C104.698 10.5273 104.507 10.0792 104.123 9.69531C103.803 9.31139 103.387 9.11922 102.875 9.11914H96.8271Z" />
                                    </svg>
                                </div>
                                <h3 id="detail-title">{{ $firstService->title }}</h3>
                            </div>
                            <p id="detail-description">{{ $firstService->description }}</p>

                            <div class="detail-images-row">
                                <div class="rounded-img"><img src="/storage/projects/c&c_showcase.png" alt="Service Preview"></div>
                                <div class="rounded-img"><img src="/storage/projects/cedi_showcase.png" alt="Service Preview"></div>
                                <div class="rounded-img"><img src="/storage/projects/malinalli_showcase.png" alt="Service Preview"></div>
                            </div>

                            <a href="#contacto" class="service-cta primary-glow" id="detail-button" style="--item-color: #f97316; --item-glow: rgba(249, 115, 22, 0.4);">
                                <i class="{{ $firstService->icon ?? 'fa-solid fa-code' }}" id="btn-icon"></i>
                                <span id="btn-text">{{ $firstService->button_text ?? 'Saber más' }}</span>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="service-card glass-card hover-glow-purple w-100">
                        <div class="service-icon"><i class="fa-solid fa-code"></i></div>
                        <h3>Servicios listos</h3>
                        <p>Agrega servicios desde tu nuevo panel de administrador.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="proyectos" class="projects section-padding">
        <div class="container container-wide">
            <div class="section-title text-center">
                <h2>Mis <span>Proyectos</span></h2>
                <p>Una selección de mis trabajos más destacados, donde la arquitectura digital se encuentra con la
                    precisión.</p>
            </div>
            <div class="bento-grid">
                <div class="bento-item item-large">
                    <div style="position: absolute; top: 15px; left: 15px; background: #f97316; color: white; border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.2rem; z-index: 10; box-shadow: 0 0 15px rgba(249,115,22,0.5);">1</div>
                    <img src="/storage/projects/c&c_showcase.png" alt="C&C Showcase">
                    <div class="bento-overlay">
                        <h3>Arquitectura Digital</h3>
                        <p>Diseño de sistemas complejos para C&C</p>
                    </div>
                </div>
                <div class="bento-item item-medium">
                    <div style="position: absolute; top: 15px; left: 15px; background: #f97316; color: white; border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.2rem; z-index: 10; box-shadow: 0 0 15px rgba(249,115,22,0.5);">2</div>
                    <img src="/storage/projects/cedi_showcase.png" alt="CEDI Showcase">
                    <div class="bento-overlay">
                        <h3>E-commerce Pro</h3>
                        <p>Plataforma CEDI optimizada</p>
                    </div>
                </div>
                <div class="bento-item item-small">
                    <div style="position: absolute; top: 15px; left: 15px; background: #f97316; color: white; border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.2rem; z-index: 10; box-shadow: 0 0 15px rgba(249,115,22,0.5);">3</div>
                    <img src="/storage/projects/dg_showcase.png" alt="DG Showcase">
                    <div class="bento-overlay">
                        <h3>Branding Digital</h3>
                        <p>Identidad visual para DG</p>
                    </div>
                </div>
                <div class="bento-item item-small">
                    <div style="position: absolute; top: 15px; left: 15px; background: #f97316; color: white; border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.2rem; z-index: 10; box-shadow: 0 0 15px rgba(249,115,22,0.5);">4</div>
                    <img src="/storage/projects/starmex_showcase.png" alt="Starmex Showcase">
                    <div class="bento-overlay">
                        <h3>Sistemas Web</h3>
                        <p>Panel administrativo Starmex</p>
                    </div>
                </div>
                <div class="bento-item item-wide">
                    <div style="position: absolute; top: 15px; left: 15px; background: #f97316; color: white; border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.2rem; z-index: 10; box-shadow: 0 0 15px rgba(249,115,22,0.5);">5</div>
                    <img src="/storage/projects/malinalli_showcase.png" alt="Malinalli Showcase">
                    <div class="bento-overlay">
                        <h3>Marketing de Datos</h3>
                        <p>Estrategia digital Malinalli</p>
                    </div>
                </div>
                <div class="bento-item item-small">
                    <div style="position: absolute; top: 15px; left: 15px; background: #f97316; color: white; border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.2rem; z-index: 10; box-shadow: 0 0 15px rgba(249,115,22,0.5);">6</div>
                    <img src="/storage/projects/spromo_showcase.png" alt="Spromo Showcase">
                    <div class="bento-overlay">
                        <h3>Chatbots IA</h3>
                        <p>Automatización inteligente Spromo</p>
                    </div>
                </div>
                <div class="bento-item item-small">
                    <div style="position: absolute; top: 15px; left: 15px; background: #f97316; color: white; border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.2rem; z-index: 10; box-shadow: 0 0 15px rgba(249,115,22,0.5);">7</div>
                    <img src="/storage/projects/spromo_showcase.png" alt="Proyecto Nuevo">
                    <div class="bento-overlay">
                        <h3>Próximo Proyecto</h3>
                        <p>Innovación en desarrollo</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing section-padding dark-bg relative">
        <div class="blur-blob purple-blob small-blob right-center"></div>
        <div class="container relative-z">
            <div class="section-title text-center">
                <h2>Mi oferta de <span>planes</span></h2>
                <p>Checa mi tabla de precios y dime que te parece, mándame mensaje si buscas algo mas especifico para tu
                    proyecto.</p>
            </div>
            <div class="pricing-grid">
                @forelse($plans as $plan)
                    <div class="pricing-card glass-card {{ $plan->is_popular ? 'popular highlight-border' : '' }}">
                        @if($plan->badge)
                            <div class="badge">{{ $plan->badge }}</div>
                        @elseif($plan->discount_percentage)
                            <div class="badge" style="background: #e91e63;">-{{ $plan->discount_percentage }}% OFF</div>
                        @endif
                        <h3>{{ $plan->name }}</h3>

                        @if($plan->discount_percentage)
                            <div style="text-decoration: line-through; color: #aaa; font-size: 1.2rem; margin-bottom: -10px;">
                                ${{ number_format($plan->price, 0) }}
                            </div>
                            <div class="price">
                                <span>$</span>{{ number_format($plan->price * (1 - ($plan->discount_percentage / 100)), 0) }}<span>/mes</span>
                            </div>
                        @else
                            <div class="price"><span>$</span>{{ number_format($plan->price, 0) }}<span>/mes</span></div>
                        @endif
                        <ul class="features">
                            @foreach($plan->features as $feature)
                                <li class="{{ !$feature->is_included ? 'disabled' : '' }}">
                                    <i
                                        class="fa-solid {{ $feature->is_included ? 'fa-check text-green' : 'fa-xmark text-muted' }}"></i>
                                    {{ $feature->name }}
                                </li>
                            @endforeach
                        </ul>
                        <button class="cta-button {{ $plan->is_popular ? 'primary-glow' : 'secondary-glass' }} w-100"
                            onclick="document.getElementById('contacto').scrollIntoView({behavior: 'smooth'})">{{ $plan->button_text ?: 'Empezar ahora' }}</button>
                    </div>
                @empty
                    <div class="pricing-card glass-card">
                        <h3>Sin Planes</h3>
                        <div class="price"><span>$</span>0<span>/mes</span></div>
                        <ul class="features">
                            <li><i class="fa-solid fa-check text-green"></i> Agrega planes en tu dashboard</li>
                        </ul>
                    </div>
                @endforelse
            </div>
        </div>
    </section>


    <!-- Contact Form Section -->
    <section id="contacto" class="contact section-padding dark-bg relative">
        <div class="blur-blob orange-blob small-blob left-bottom"></div>
        <div class="container relative-z">
            <div class="contact-wrapper">
                <div class="contact-info">
                    <h2>¿Hablamos por <span>Teléfono</span>?</h2>
                    <p>Mi propuesta es simple: déjame tu número y agendamos una breve llamada para aterrizar tu proyecto y ver cómo puedo ayudarte.</p>
                    <div class="info-items">
                        <div class="info-item">
                            <i class="fa-solid fa-calendar-check"></i>
                            <span>Tú eliges el mejor momento</span>
                        </div>
                        <div class="info-item">
                            <i class="fa-solid fa-clock"></i>
                            <span>Llamada de 10-15 minutos</span>
                        </div>
                        <div class="info-item">
                            <i class="fa-solid fa-bolt"></i>
                            <span>Sin rodeos, directo al grano</span>
                        </div>
                    </div>
                </div>
                <div class="contact-form-container">
                    <form id="multi-step-form" class="multi-step-form">
                        @csrf
                        <!-- Step 1: Phone -->
                        <div class="form-step active" id="step-1">
                            <div class="form-group">
                                <label for="phone">Tu número de teléfono</label>
                                <input type="tel" id="phone" name="phone" required placeholder="Ej. +52 123 456 7890">
                            </div>
                            <button type="button" class="cta-button primary-glow w-100 next-step mt-1" data-next="2" style="margin-top: 1.5rem;">Agendar llamada</button>
                        </div>

                        <!-- Step 2: Date/Time -->
                        <div class="form-step" id="step-2">
                            <div class="form-group">
                                <label for="date">¿Qué día te viene bien?</label>
                                <input type="text" id="date" name="date" class="custom-date-picker" required placeholder="Selecciona una fecha">
                            </div>
                            <div class="form-group" style="margin-top: 1rem;">
                                <label for="time">¿A qué hora?</label>
                                <input type="text" id="time" name="time" class="custom-time-picker" required placeholder="Selecciona una hora">
                            </div>
                            <div class="d-flex gap-1" style="margin-top: 1.5rem;">
                                <button type="button" class="cta-button secondary-glass prev-step" data-prev="1">Atrás</button>
                                <button type="button" class="cta-button primary-glow w-100 next-step" data-next="3">Siguiente</button>
                            </div>
                        </div>

                        <!-- Step 3: Name -->
                        <div class="form-step" id="step-3">
                            <div class="form-group">
                                <label for="full_name">¿Con quién tendré el gusto de hablar?</label>
                                <input type="text" id="full_name" name="name" required placeholder="Tu nombre completo">
                            </div>
                            <div class="d-flex gap-1" style="margin-top: 1.5rem;">
                                <button type="button" class="cta-button secondary-glass prev-step" data-prev="2">Atrás</button>
                                <button type="submit" class="cta-button primary-glow w-100">Confirmar cita</button>
                            </div>
                        </div>

                        <!-- Success Step -->
                        <div class="form-step" id="step-success">
                            <div class="success-content text-center">
                                <div class="success-icon"><i class="fa-solid fa-circle-check"></i></div>
                                <h3>¡Cita agendada!</h3>
                                <p>Recibirás un mensaje de confirmación pronto. Estaré listo para platicar contigo en la fecha seleccionada.</p>
                                <button type="button" class="cta-button secondary-glass mt-1" onclick="location.reload()">Regresar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <div style="margin-bottom: 1.5rem; display: flex; justify-content: center; align-items: center;">
                <!-- Inline SVG Logo -->
                <svg style="height: 30px;" viewBox="0 0 380 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M5.14258 19.0713H13.4404V63.0713H0V0.959961H8.9375L5.14258 19.0713ZM36.3496 0C41.0216 0 44.35 1.53542 46.334 4.60742C48.19 1.53562 51.5176 6.26624e-05 56.3174 0H63.4219C71.3577 7.03886e-05 75.3262 4.22395 75.3262 12.6719V63.0713H61.8857V11.5195C61.8857 11.0076 61.6935 10.5598 61.3096 10.1758C60.9896 9.79178 60.5735 9.59961 60.0615 9.59961H54.8779C54.3659 9.59961 53.9172 9.79178 53.5332 10.1758C53.2134 10.5597 53.0537 11.0077 53.0537 11.5195V63.0713H39.6133V11.5195C39.6133 11.0077 39.4219 10.5597 39.0381 10.1758C38.7182 9.79187 38.3019 9.5997 37.79 9.59961H32.6055C32.0936 9.59966 31.6457 9.79183 31.2617 10.1758C30.9418 10.5597 30.7812 11.0076 30.7812 11.5195V63.0713H17.3418V12.6719C17.3418 4.22388 21.3101 0 29.2461 0H36.3496ZM106.234 0C114.17 0 118.139 4.22388 118.139 12.6719V63.0713H104.698V42.2393H95.0029V63.0713H81.5625V12.6719C81.5625 4.22388 85.5308 0 93.4668 0H106.234ZM137.597 51.7432H152.284V63.0713H124.156V0.959961H137.597V51.7432ZM171.097 51.7432H185.784V63.0713H157.656V0.959961H171.097V51.7432ZM218.477 11.9033H203.597V26.4951H217.517V37.0557H203.597V51.9355H218.477V63.0713H190.156V0.959961H218.477V11.9033ZM247.962 0C255.898 0 259.866 4.22388 259.866 12.6719V50.293C258.69 50.5934 257.645 51.1999 256.731 52.1133C255.371 53.4743 254.69 55.127 254.69 57.0713C254.69 59.0156 255.371 60.6683 256.731 62.0293C257.141 62.4384 257.577 62.7851 258.039 63.0713H246.426V11.5195C246.426 11.0077 246.234 10.5597 245.851 10.1758C245.531 9.79187 245.114 9.5997 244.603 9.59961H239.418C238.906 9.59966 238.458 9.79183 238.074 10.1758C237.754 10.5597 237.594 11.0076 237.594 11.5195V63.0713H224.154V12.6719C224.154 4.22388 228.123 0 236.059 0H247.962ZM333.83 11.9033H318.95V26.4951H332.87V37.0557H318.95V51.9355H343.83L345.83 63.0713H305.51V0.959961H333.83V11.9033ZM359.076 46.2715L366.66 0.959961H379.62L366.756 63.0713H351.3L338.436 0.959961H351.492L359.076 46.2715ZM288.588 0.959961C296.524 0.959961 300.492 5.18384 300.492 13.6318V50.3994C300.492 58.8474 296.524 63.0713 288.588 63.0713H265.342C265.803 62.7852 266.239 62.4383 266.648 62.0293C268.009 60.6682 268.69 59.0157 268.69 57.0713C268.69 55.1269 268.009 53.4744 266.648 52.1133C265.841 51.3054 264.929 50.7385 263.916 50.4102V0.959961H288.588ZM277.356 53.8555H285.229C285.74 53.8554 286.157 53.6632 286.477 53.2793C286.86 52.8954 287.052 52.4474 287.052 51.9355V11.999C287.052 11.4872 286.86 11.0391 286.477 10.6553C286.157 10.2713 285.74 10.0792 285.229 10.0791H277.356V53.8555ZM96.8271 9.11914C96.3151 9.11914 95.8664 9.31131 95.4824 9.69531C95.1625 10.0792 95.003 10.5273 95.0029 11.0391V31.8711H104.698V11.0391C104.698 10.5273 104.507 10.0792 104.123 9.69531C103.803 9.31139 103.387 9.11922 102.875 9.11914H96.8271Z"
                        fill="white" />
                </svg>
            </div>
            <p>&copy; 2026 imallen.dev. Todos los derechos reservados.</p>
            <div class="social-links mt-1">
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                <a href="#"><i class="fa-brands fa-github"></i></a>
            </div>
        </div>
    </footer>

    <script>
        // Multi-step Contact Form Logic
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.getElementById('multi-step-form');
            if (!form) return;

            const steps = form.querySelectorAll('.form-step');
            const nextBtns = form.querySelectorAll('.next-step');
            const prevBtns = form.querySelectorAll('.prev-step');

            nextBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const nextStepId = `step-${btn.dataset.next}`;
                    const currentStep = btn.closest('.form-step');
                    
                    // Basic validation for current step
                    const inputs = currentStep.querySelectorAll('input, select, textarea');
                    let isValid = true;
                    inputs.forEach(input => {
                        if (!input.checkValidity()) {
                            input.reportValidity();
                            isValid = false;
                        }
                    });

                    if (isValid) {
                        currentStep.classList.remove('active');
                        document.getElementById(nextStepId).classList.add('active');
                    }
                });
            });

            prevBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const prevStepId = `step-${btn.dataset.prev}`;
                    const currentStep = btn.closest('.form-step');
                    currentStep.classList.remove('active');
                    document.getElementById(prevStepId).classList.add('active');
                });
            });

            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                // Here you would typically send the data to your Laravel backend
                // For now, we'll simulate a successful submission
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.textContent;
                submitBtn.disabled = true;
                submitBtn.textContent = 'Enviando...';

                try {
                    // Simulate API call
                    await new Promise(resolve => setTimeout(resolve, 1500));
                    
                    form.querySelector('.form-step.active').classList.remove('active');
                    document.getElementById('step-success').classList.add('active');
                } catch (error) {
                    alert('Hubo un error al procesar tu solicitud. Por favor intenta de nuevo.');
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                }
            });

            // Interactive Services Script
            const detailCard = document.getElementById('service-detail');
            const detailOverlay = document.getElementById('service-overlay');
            const detailTitle = document.getElementById('detail-title');
            const detailDescription = document.getElementById('detail-description');
            const detailIcon = document.getElementById('detail-icon');
            const selectionItems = document.querySelectorAll('.selection-item');

            if (detailCard) {
                // Three.js Setup
                const container = document.getElementById('sphere-container');
                const sphereGlow = document.getElementById('sphere-glow');
                const scene = new THREE.Scene();
                const camera = new THREE.PerspectiveCamera(75, container.clientWidth / container.clientHeight, 0.1, 1000);
                const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
                renderer.setSize(container.clientWidth, container.clientHeight);
                renderer.setPixelRatio(window.devicePixelRatio);
                container.appendChild(renderer.domElement);
                container.style.transition = 'filter 0.5s ease';
                container.style.filter = 'drop-shadow(0 0 50px #f97316aa)';
                sphereGlow.style.background = '#f97316';

                // Shader Material for Organic Sphere
                const vertexShader = `
                    varying vec2 vUv;
                    varying float vDistortion;
                    uniform float uTime;
                    uniform float uHover;
                    uniform float uNoiseScale;
                    uniform float uNoiseSpeed;

                    // Perlin Noise function
                    vec3 mod289(vec3 x) { return x - floor(x * (1.0 / 289.0)) * 289.0; }
                    vec4 mod289(vec4 x) { return x - floor(x * (1.0 / 289.0)) * 289.0; }
                    vec4 permute(vec4 x) { return mod289(((x*34.0)+1.0)*x); }
                    vec4 taylorInvSqrt(vec4 r) { return 1.79284291400159 - 0.85373472095314 * r; }
                    float snoise(vec3 v) {
                        const vec2  C = vec2(1.0/6.0, 1.0/3.0) ;
                        const vec4  D = vec4(0.0, 0.5, 1.0, 2.0);
                        vec3 i  = floor(v + dot(v, C.yyy) );
                        vec3 x0 =   v - i + dot(i, C.xxx) ;
                        vec3 g = step(x0.yzx, x0.xyz);
                        vec3 l = 1.0 - g;
                        vec3 i1 = min( g.xyz, l.zxy );
                        vec3 i2 = max( g.xyz, l.zxy );
                        vec3 x1 = x0 - i1 + C.xxx;
                        vec3 x2 = x0 - i2 + C.yyy;
                        vec3 x3 = x0 - D.yyy;
                        i = mod289(i);
                        vec4 p = permute( permute( permute(
                                    i.z + vec4(0.0, i1.z, i2.z, 1.0 ))
                                + i.y + vec4(0.0, i1.y, i2.y, 1.0 ))
                                + i.x + vec4(0.0, i1.x, i2.x, 1.0 ));
                        float n_ = 0.142857142857;
                        vec3  ns = n_ * D.wyz - D.xzx;
                        vec4 j = p - 49.0 * floor(p * ns.z * ns.z);
                        vec4 x_ = floor(j * ns.z);
                        vec4 y_ = floor(j - 7.0 * x_ );
                        vec4 x = x_ *ns.x + ns.yyyy;
                        vec4 y = y_ *ns.x + ns.yyyy;
                        vec4 h = 1.0 - abs(x) - abs(y);
                        vec4 b0 = vec4( x.xy, y.xy );
                        vec4 b1 = vec4( x.zw, y.zw );
                        vec4 s0 = floor(b0)*2.0 + 1.0;
                        vec4 s1 = floor(b1)*2.0 + 1.0;
                        vec4 sh = -step(h, vec4(0.0));
                        vec4 a0 = b0.xzyw + s0.xzyw*sh.xxyy ;
                        vec4 a1 = b1.xzyw + s1.xzyw*sh.zzww ;
                        vec3 p0 = vec3(a0.xy,h.x);
                        vec3 p1 = vec3(a0.zw,h.y);
                        vec3 p2 = vec3(a1.xy,h.z);
                        vec3 p3 = vec3(a1.zw,h.w);
                        vec4 norm = taylorInvSqrt(vec4(dot(p0,p0), dot(p1,p1), dot(p2, p2), dot(p3,p3)));
                        p0 *= norm.x;
                        p1 *= norm.y;
                        p2 *= norm.z;
                        p3 *= norm.w;
                        vec4 m = max(0.6 - vec4(dot(x0,x0), dot(x1,x1), dot(x2,x2), dot(x3,x3)), 0.0);
                        m = m * m;
                        return 42.0 * dot( m*m, vec4( dot(p0,x0), dot(p1,x1),
                                                        dot(p2,x2), dot(p3,x3) ) );
                    }

                    void main() {
                        vUv = uv;
                        float noise = snoise(vec3(position * uNoiseScale + uTime * uNoiseSpeed));
                        vDistortion = noise * (0.3 + uHover * 0.4);
                        vec3 newPosition = position + normal * vDistortion;
                        gl_Position = projectionMatrix * modelViewMatrix * vec4(newPosition, 1.0);
                    }
                `;

                const fragmentShader = `
                    varying vec2 vUv;
                    varying float vDistortion;
                    uniform float uTime;
                    uniform vec3 uColor1;
                    uniform vec3 uColor2;

                    void main() {
                        float intensity = vDistortion * 2.0 + 0.5;
                        vec3 finalColor = mix(uColor1, uColor2, intensity);
                        gl_FragColor = vec4(finalColor, 0.5 + intensity * 0.5);
                    }
                `;

                const geometry = new THREE.SphereGeometry(2, 64, 64);
                const material = new THREE.ShaderMaterial({
                    vertexShader,
                    fragmentShader,
                    uniforms: {
                        uTime: { value: 0 },
                        uHover: { value: 0 },
                        uNoiseScale: { value: 2.0 },
                        uNoiseSpeed: { value: 0.3 },
                        uColor1: { value: new THREE.Color(0.97, 0.45, 0.08) },
                        uColor2: { value: new THREE.Color(0.98, 0.75, 0.14) }
                    },
                    transparent: true,
                    wireframe: false
                });

                const sphere = new THREE.Mesh(geometry, material);
                scene.add(sphere);

                camera.position.z = 5;

                const section = document.getElementById('servicios');
                const selectionList = document.querySelector('.service-selection-list');
                
                // Initial position at center
                const rect = section.getBoundingClientRect();
                let targetX = rect.width / 2;
                let targetY = rect.height / 2;
                let mouseX = targetX;
                let mouseY = targetY;
                
                let isHoveringSelection = false;

                section.addEventListener('mousemove', (e) => {
                    if (isHoveringSelection) return;

                    const rect = section.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;

                    targetX = x;
                    targetY = y;
                });

                // Toggle between custom sphere cursor and system cursor
                selectionList.addEventListener('mouseenter', () => {
                    isHoveringSelection = true;
                    section.style.cursor = 'auto';
                    // The sphere remains visible but frozen in its last position
                });

                selectionList.addEventListener('mouseleave', () => {
                    isHoveringSelection = false;
                    section.style.cursor = 'none';
                });

                section.addEventListener('mouseleave', () => {
                    hoverTarget = 0;
                });

                // Animation loop
                let hoverTarget = 0;
                function animate(time) {
                    material.uniforms.uTime.value = time * 0.001;

                    // Smooth mouse follow (lerp)
                    mouseX += (targetX - mouseX) * 0.15; // Faster follow for cursor feel
                    mouseY += (targetY - mouseY) * 0.15;

                    // Direct position follow
                    container.style.left = `${mouseX}px`;
                    container.style.top = `${mouseY}px`;
                    if (sphereGlow) {
                        sphereGlow.style.left = `${mouseX}px`;
                        sphereGlow.style.top = `${mouseY}px`;
                    }

                    // Smooth hover transition
                    material.uniforms.uHover.value += (hoverTarget - material.uniforms.uHover.value) * 0.05;

                    sphere.rotation.y += 0.002;
                    sphere.rotation.x += 0.001;

                    renderer.render(scene, camera);
                    requestAnimationFrame(animate);
                }
                animate(0);

                // Resize handler
                window.addEventListener('resize', () => {
                    camera.aspect = container.clientWidth / container.clientHeight;
                    camera.updateProjectionMatrix();
                    renderer.setSize(container.clientWidth, container.clientHeight);
                });

                // Hover interaction
                detailCard.addEventListener('mouseenter', () => hoverTarget = 1);
                detailCard.addEventListener('mouseleave', () => hoverTarget = 0);

                // Selection Logic
                selectionItems.forEach(item => {
                    item.addEventListener('click', () => {
                        if (item.classList.contains('active')) return;
                        selectionItems.forEach(i => i.classList.remove('active'));
                        item.classList.add('active');

                        const detailTitle = document.getElementById('detail-title');
                        const detailDescription = document.getElementById('detail-description');
                        const detailIcon = document.getElementById('detail-icon');
                        const detailButton = document.getElementById('detail-button');

                        detailOverlay.classList.add('changing');

                        // Update Sphere Theme
                        const c1 = JSON.parse(item.getAttribute('data-c1'));
                        const c2 = JSON.parse(item.getAttribute('data-c2'));
                        const scale = parseFloat(item.getAttribute('data-scale'));
                        const speed = parseFloat(item.getAttribute('data-speed'));

                        // Transition uniforms
                        const duration = 1000; // 1s transition
                        const startScale = material.uniforms.uNoiseScale.value;
                        const startSpeed = material.uniforms.uNoiseSpeed.value;
                        const startC1 = material.uniforms.uColor1.value.clone();
                        const startC2 = material.uniforms.uColor2.value.clone();
                        const startTime = performance.now();

                        function updateUniforms(now) {
                            const progress = Math.min((now - startTime) / duration, 1);
                            const ease = 1 - Math.pow(1 - progress, 3); // Ease out cubic

                            material.uniforms.uNoiseScale.value = startScale + (scale - startScale) * ease;
                            material.uniforms.uNoiseSpeed.value = startSpeed + (speed - startSpeed) * ease;

                            material.uniforms.uColor1.value.lerpColors(startC1, new THREE.Color(...c1), ease);
                            material.uniforms.uColor2.value.lerpColors(startC2, new THREE.Color(...c2), ease);

                            // Dynamic Glow update (Potent)
                            const hexColor = item.getAttribute('data-hex');
                            container.style.filter = `drop-shadow(0 0 80px ${hexColor}cc)`;
                            sphereGlow.style.background = hexColor;

                            // Update button styles dynamically
                            detailButton.style.setProperty('--item-color', hexColor);
                            detailButton.style.setProperty('--item-glow', hexColor + '44');

                            if (progress < 1) requestAnimationFrame(updateUniforms);
                        }
                        requestAnimationFrame(updateUniforms);

                        setTimeout(() => {
                            detailTitle.textContent = item.getAttribute('data-title');
                            detailDescription.textContent = item.getAttribute('data-description');

                            const btnIcon = document.getElementById('btn-icon');
                            const btnText = document.getElementById('btn-text');
                            const floatingSvg = document.getElementById('detail-svg');

                            if (btnIcon) btnIcon.className = item.getAttribute('data-icon');
                            if (btnText) btnText.textContent = item.getAttribute('data-btn-text');
                            if (floatingSvg) floatingSvg.style.cssText = item.getAttribute('data-svg-pos');

                            detailOverlay.classList.remove('changing');
                        }, 300);
                    });
                });
            }
        });
    </script>
    
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr(".custom-date-picker", {
                locale: "es",
                minDate: "today",
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                disableMobile: true // Prevents native UI on mobile so custom is always used
            });
            flatpickr(".custom-time-picker", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: false,
                altInput: true,
                altFormat: "h:i K",
                disableMobile: true // Prevents native UI on mobile so custom is always used
            });
        });
    </script>
</body>

</html>
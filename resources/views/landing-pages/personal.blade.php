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

    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/0.160.0/three.min.js"></script>
    <style>
        :root {
            --gradient-start: {{ $gradientColor1 ?? '#8b5cf6' }};
            --gradient-end: {{ $gradientColor2 ?? '#f97316' }};
        }

        .section-title span {
            background-image: linear-gradient(135deg, var(--gradient-start), var(--gradient-end)) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
        }

        .highlight-border::before {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end)) !important;
        }

        .badge {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end)) !important;
        }

        .hero-title {
            font-size: clamp(2rem, 8vw, 4.5rem) !important;
        }

        .hero-personal-bg {
            max-width: 100% !important;
            margin: 0 !important;
            padding: 0 max(2vw, calc(50vw - 680px)) !important;
            background-image:
                url('{{ ($heroSubject ?? null) ? Storage::url($heroSubject) : '/storage/images/herop-sujeto.png' }}'),
                url('{{ ($heroBg ?? null) ? Storage::url($heroBg) : '/storage/images/herop-fondo.png' }}');
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

        .hero-personal-bg .hero-content {
            text-align: left !important;
            align-items: flex-start !important;
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
                min-height: 100vh;
                min-height: 100dvh;
                display: flex;
                align-items: flex-start;
                padding: 120px 20px 40px 20px !important;
                text-align: left !important;
                background-size:
                    auto 60%,
                    cover;
                background-position:
                    center bottom,
                    center center;
                overflow: hidden;
            }

            .hero-personal-bg .hero-content {
                max-width: 100%;
                z-index: 10;
                position: relative;
                text-align: left;
                align-items: flex-start !important;
                padding: 0 !important;
            }

            .hero-personal-bg .hero-content h1,
            .hero-personal-bg .hero-content p {
                text-align: left !important;
            }

            .hero-personal-bg .hero-content .hero-subtitle {
                max-width: 560px !important;
            }

            .hero-mini-carousel {
                display: none;
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
            color: var(--item-text-color, #ffffff);
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
                transform: translateX(calc(-110px * {{ $projects->count() }} - 12px * {{ $projects->count() }}));
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

        /* Custom Date/Time Selectors */
        .date-options,
        .time-options {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
        }

        @media (min-width: 640px) {
            .date-options,
            .time-options {
                display: flex;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                padding-bottom: 4px;
                scrollbar-width: none;
            }

            .date-options::-webkit-scrollbar,
            .time-options::-webkit-scrollbar {
                display: none;
            }
        }

        .time-groups {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .time-group-label {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.4);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 2px;
            cursor: pointer;
            padding: 6px 14px;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.25s ease;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
            display: inline-block;
        }

        .time-group-label:hover {
            background: rgba(255, 255, 255, 0.08);
        }

        .time-group-label.active {
            background: rgba(249, 115, 22, 0.15);
            border-color: #f97316;
            color: #ffffff;
        }

        .time-period {
            display: none;
        }

        .time-period.active {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
        }

        .time-period .date-options {
            display: contents;
        }

        @media (min-width: 640px) {
            .time-period.active {
                display: flex;
            }

            .time-period .date-options {
                display: flex;
                gap: 8px;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                padding-bottom: 4px;
                scrollbar-width: none;
            }

            .time-period .date-options::-webkit-scrollbar {
                display: none;
            }
        }

        .date-option,
        .time-option {
            padding: 10px 14px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            transition: all 0.25s ease;
            text-align: center;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
            min-width: 0;
        }

        .date-option:hover,
        .time-option:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .date-option.active,
        .time-option.active {
            background: rgba(249, 115, 22, 0.15);
            border-color: #f97316;
            color: #ffffff;
            box-shadow: 0 0 15px rgba(249, 115, 22, 0.2);
        }

        .date-day {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
            opacity: 0.7;
        }

        .date-option.active .date-day {
            opacity: 1;
        }

        .date-num {
            font-size: 1.2rem;
            font-weight: 700;
            line-height: 1;
        }

        .date-month {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 2px;
            opacity: 0.5;
        }

        .date-option.active .date-month {
            opacity: 0.8;
        }

        .time-option {
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* Contact Toggle Phone/Email */
        .contact-toggle {
            display: flex;
            gap: 0;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            flex-shrink: 0;
        }

        .toggle-option {
            padding: 0.75rem 1rem;
            border: none;
            background: transparent;
            color: rgba(255, 255, 255, 0.4);
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            line-height: 1;
        }

        .toggle-option.active {
            background: #f97316;
            color: white;
        }

        .toggle-option:hover:not(.active) {
            color: rgba(255, 255, 255, 0.7);
        }

        /* Disable bento hover effects */
        .bento-item {
            cursor: pointer !important;
            overflow: hidden;
        }

        .bento-item img {
            transition: transform 0.5s cubic-bezier(0.23, 1, 0.32, 1) !important;
        }

        .bento-item:hover img {
            transform: scale(1.08) !important;
        }

        .bento-item:hover {
            border-color: #f97316 !important;
            box-shadow: 0 0 20px rgba(249, 115, 22, 0.3) !important;
        }

        .bento-overlay {
            background: linear-gradient(to top, rgba(249, 115, 22, 0.5), transparent) !important;
            opacity: 0 !important;
            transition: opacity 0.4s ease !important;
        }

        .bento-item:hover .bento-overlay {
            opacity: 1 !important;
        }

        /* Project link cards */
        .bento-link {
            display: block;
            text-decoration: none;
            color: inherit;
        }

        /* Project Modal */
        .project-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(10px);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .project-modal-overlay.active {
            display: flex;
            opacity: 1;
        }

        .project-modal {
            background: #0a0a0f;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            max-width: 700px;
            width: 100%;
            max-height: 85vh;
            overflow-y: auto;
            position: relative;
        }

        .project-modal-close {
            position: absolute;
            top: 16px;
            right: 16px;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: background 0.2s;
        }

        .project-modal-close:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .project-modal-gallery {
            width: 100%;
            overflow-x: auto;
            display: flex;
            gap: 8px;
            padding: 16px;
            -webkit-overflow-scrolling: touch;
        }

        .project-modal-gallery img {
            height: 220px;
            border-radius: 12px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .project-modal-body {
            padding: 0 24px 24px;
        }

        .project-modal-body h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.5rem;
        }

        .project-modal-body .modal-desc {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .project-modal-body .modal-techs {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 1.5rem;
        }

        .project-modal-body .modal-techs span {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .project-modal-links {
            display: flex;
            gap: 10px;
        }

        .project-modal-links a {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .project-modal-links a:hover {
            background: #f97316;
            border-color: #f97316;
            color: white;
        }

        /* Services: center pills + no padding on detail card */
        .service-selection-list {
            justify-content: center;
        }

        .service-detail-card {
            padding-left: 0 !important;
            padding-right: 0 !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        /* Services mobile: tabs on top */
        @media (max-width: 992px) {
            .services-interactive-container {
                grid-template-columns: 1fr !important;
                gap: 1.5rem !important;
            }

            .service-selection-list {
                order: -1 !important;
                flex-direction: row !important;
                justify-content: center !important;
                overflow-x: auto !important;
                gap: 0.6rem !important;
                padding-bottom: 0.5rem;
                -webkit-overflow-scrolling: touch;
            }

            .service-detail-card {
                padding-left: 0 !important;
                padding-right: 0 !important;
                margin-left: 0 !important;
                margin-right: 0 !important;
            }

            .service-selection-list .selection-item {
                padding: 0.8rem 1.2rem !important;
                white-space: nowrap;
                flex-shrink: 0;
                border-radius: 50px !important;
                gap: 0.5rem;
            }

            .service-selection-list .selection-item span {
                font-size: 0.8rem;
                display: none;
            }

            .service-selection-list .selection-item.active span {
                display: inline;
            }

            .service-selection-list .selection-item {
                padding: 0.7rem !important;
            }

            .service-selection-list .selection-item.active {
                padding: 0.7rem 1.2rem !important;
            }
        }
    </style>

</head>

<body>
    <x-gtm-body />
    {{-- @var heroTitle:text --}}
    {{-- @var heroSubtitle:text --}}
    {{-- @var heroImage:image --}}
    {{-- @var heroBg:image --}}
    {{-- @var heroSubject:image --}}
    {{-- @var showCta:toggle --}}
    {{-- @var ctaText:text --}}
    {{-- @var servicesSectionTitle:text --}}
    {{-- @var servicesSectionSubtitle:text --}}
    {{-- @var gradientColor1:text --}}
    {{-- @var gradientColor2:text --}}
    {{-- @var projectsSectionTitle:text --}}
    {{-- @var projectsSectionSubtitle:text --}}
    {{-- @var pricingSectionTitle:text --}}
    {{-- @var pricingSectionSubtitle:text --}}
    {{-- @var contactSectionTitle:text --}}
    {{-- @var contactSectionSubtitle:text --}}
    {{-- @var contactListItem1:text --}}
    {{-- @var contactListItem2:text --}}
    {{-- @var contactListItem3:text --}}

    <!-- Header -->
    <header id="main-header"
        style="padding: 1.2rem 5%; width: 100%; position: fixed; top: 0; left: 0; right: 0; z-index: 1000; display: flex; justify-content: center; align-items: center; transition: all 0.3s ease;">
        <div
            style="width: 100%; max-width: 1400px; display: flex; justify-content: space-between; align-items: center;">
            <a href="/">
                <!-- Inline SVG Logo -->
                <svg style="height: 30px;" viewBox="0 0 380 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M5.14258 19.0713H13.4404V63.0713H0V0.959961H8.9375L5.14258 19.0713ZM36.3496 0C41.0216 0 44.35 1.53542 46.334 4.60742C48.19 1.53562 51.5176 6.26624e-05 56.3174 0H63.4219C71.3577 7.03886e-05 75.3262 4.22395 75.3262 12.6719V63.0713H61.8857V11.5195C61.8857 11.0076 61.6935 10.5598 61.3096 10.1758C60.9896 9.79178 60.5735 9.59961 60.0615 9.59961H54.8779C54.3659 9.59961 53.9172 9.79178 53.5332 10.1758C53.2134 10.5597 53.0537 11.0077 53.0537 11.5195V63.0713H39.6133V11.5195C39.6133 11.0077 39.4219 10.5597 39.0381 10.1758C38.7182 9.79187 38.3019 9.5997 37.79 9.59961H32.6055C32.0936 9.59966 31.6457 9.79183 31.2617 10.1758C30.9418 10.5597 30.7812 11.0076 30.7812 11.5195V63.0713H17.3418V12.6719C17.3418 4.22388 21.3101 0 29.2461 0H36.3496ZM106.234 0C114.17 0 118.139 4.22388 118.139 12.6719V63.0713H104.698V42.2393H95.0029V63.0713H81.5625V12.6719C81.5625 4.22388 85.5308 0 93.4668 0H106.234ZM137.597 51.7432H152.284V63.0713H124.156V0.959961H137.597V51.7432ZM171.097 51.7432H185.784V63.0713H157.656V0.959961H171.097V51.7432ZM218.477 11.9033H203.597V26.4951H217.517V37.0557H203.597V51.9355H218.477V63.0713H190.156V0.959961H218.477V11.9033ZM247.962 0C255.898 0 259.866 4.22388 259.866 12.6719V50.293C258.69 50.5934 257.645 51.1999 256.731 52.1133C255.371 53.4743 254.69 55.127 254.69 57.0713C254.69 59.0156 255.371 60.6683 256.731 62.0293C257.141 62.4384 257.577 62.7851 258.039 63.0713H246.426V11.5195C246.426 11.0077 246.234 10.5597 245.851 10.1758C245.531 9.79187 245.114 9.5997 244.603 9.59961H239.418C238.906 9.59966 238.458 9.79183 238.074 10.1758C237.754 10.5597 237.594 11.0076 237.594 11.5195V63.0713H224.154V12.6719C224.154 4.22388 228.123 0 236.059 0H247.962ZM333.83 11.9033H318.95V26.4951H332.87V37.0557H318.95V51.9355H343.83L345.83 63.0713H305.51V0.959961H333.83V11.9033ZM359.076 46.2715L366.66 0.959961H379.62L366.756 63.0713H351.3L338.436 0.959961H351.492L359.076 46.2715ZM288.588 0.959961C296.524 0.959961 300.492 5.18384 300.492 13.6318V50.3994C300.492 58.8474 296.524 63.0713 288.588 63.0713H265.342C265.803 62.7852 266.239 62.4383 266.648 62.0293C268.009 60.6682 268.69 59.0157 268.69 57.0713C268.69 55.1269 268.009 53.4744 266.648 52.1133C265.841 51.3054 264.929 50.7385 263.916 50.4102V0.959961H288.588ZM277.356 53.8555H285.229C285.74 53.8554 286.157 53.6632 286.477 53.2793C286.86 52.8954 287.052 52.4474 287.052 51.9355V11.999C287.052 11.4872 286.86 11.0391 286.477 10.6553C286.157 10.2713 285.74 10.0792 285.229 10.0791H277.356V53.8555ZM96.8271 9.11914C96.3151 9.11914 95.8664 9.31131 95.4824 9.69531C95.1625 10.0792 95.003 10.5273 95.0029 11.0391V31.8711H104.698V11.0391C104.698 10.5273 104.507 10.0792 104.123 9.69531C103.803 9.31139 103.387 9.11922 102.875 9.11914H96.8271Z"
                        fill="white" />
                </svg>
            </a>
            @if($showCta ?? true)
            <a href="#contacto" class="cta-button secondary-glass"
                style="padding: 0.8rem 3.5rem; font-size: 1rem; border-color: rgba(249, 115, 22, 0.4) !important; box-shadow: 0 0 20px rgba(249, 115, 22, 0.3);">{{ $ctaText ?? 'Agendar' }}</a>
            @endif
        </div>
    </header>

    <section class="hero hero-personal-bg">
        <div class="hero-content" style="position: relative;">
            <img src="{{ ($heroImage ?? null) ? Storage::url($heroImage) : '/storage/images/drondji.webp' }}" alt="Hero" class="hero-corner-img">
            <h1 class="hero-title">{!! $heroTitle ?? 'Ingeniero de Software</br>y Arquitecto Digital.' !!}</h1>
            <p class="hero-subtitle" style="color:white;">
                {{ $heroSubtitle ?? 'Me dedico al software y el análisis de datos para crear sistemas completos (Web, eCommerce y Chatbots) que no solo se ven bien, sino que funcionan con precisión matemática.' }}
            </p>

            <div class="hero-mini-carousel">
                <div class="carousel-track-mini">
                    @forelse($projects as $project)
                        @php
                            $rawImage = !empty($project->images) ? $project->images[0] : null;
                            $firstImage = is_array($rawImage) ? ($rawImage['value'] ?? null) : $rawImage;
                        @endphp
                        @if($firstImage)
                            <a href="#proyectos" class="carousel-item-mini">
                                <img src="{{ Storage::url($firstImage) }}" alt="{{ $project->name }}">
                                <div class="item-label">{{ $project->name }}</div>
                            </a>
                        @endif
                    @empty
                        <a href="#proyectos" class="carousel-item-mini">
                            <img src="/storage/projects/cedi_showcase.png" alt="Proyecto">
                            <div class="item-label">Proyecto</div>
                        </a>
                    @endforelse
                    @foreach($projects as $project)
                        @php
                            $rawImage = !empty($project->images) ? $project->images[0] : null;
                            $firstImage = is_array($rawImage) ? ($rawImage['value'] ?? null) : $rawImage;
                        @endphp
                        @if($firstImage)
                            <a href="#proyectos" class="carousel-item-mini">
                                <img src="{{ Storage::url($firstImage) }}" alt="{{ $project->name }}">
                                <div class="item-label">{{ $project->name }}</div>
                            </a>
                        @endif
                    @endforeach
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
                <h2>{!! $servicesSectionTitle ?? 'Mis <span>Servicios</span>' !!}</h2>
                <p>{{ $servicesSectionSubtitle ?? 'Todos mis desarrollos cumplen con lo que hoy en dia deberian ser el estandar de la web moderna, enfocados en ayudarte a escalar.' }}</p>
            </div>
            <div class="services-interactive-container">
                @php
                    $fixedThemes = [
                        ['c1' => [0.97, 0.45, 0.08], 'c2' => [0.98, 0.75, 0.14], 'scale' => 2.0, 'speed' => 0.4, 'hex' => '#f97316', 'text' => '#ffffff'],
                        ['c1' => [0.54, 0.36, 0.96], 'c2' => [0.85, 0.27, 0.93], 'scale' => 3.5, 'speed' => 0.2, 'hex' => '#8b5cf6', 'text' => '#ffffff'],
                        ['c1' => [0.96, 0.96, 0.95], 'c2' => [0.90, 0.90, 0.88], 'scale' => 1.5, 'speed' => 0.15, 'hex' => '#f5f5f4', 'text' => '#1a1a1a'],
                    ];
                    $firstService = $services->first();
                @endphp
                @if($firstService)
                    <!-- Selection List (Left now) -->
                    <div class="service-selection-list">
                        @foreach($services as $index => $service)
                            @php $theme = $fixedThemes[$index % count($fixedThemes)]; @endphp
                            <div class="selection-item {{ $index === 0 ? 'active' : '' }}"
                                style="--item-color: {{ $theme['hex'] }}; --item-glow: {{ $theme['hex'] }}44; --item-text-color: {{ $theme['text'] }};"
                                data-title="{{ $service->title }}" data-description="{{ $service->description }}"
                                data-icon="{{ $service->icon ?? 'fa-solid fa-code' }}"
                                data-btn-text="Saber más"
                                data-c1="{{ json_encode($theme['c1']) }}" data-c2="{{ json_encode($theme['c2']) }}"
                                data-scale="{{ $theme['scale'] }}" data-speed="{{ $theme['speed'] }}"
                                data-hex="{{ $theme['hex'] }}"
                                data-text="{{ $theme['text'] }}">
                                <i class="{{ $service->icon ?? 'fa-solid fa-code' }}"></i>
                                <span>{{ $service->title }}</span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Detail Card (Right now) -->
                    <div class="service-detail-card glass-card" id="service-detail">
                        <div class="service-text-overlay" id="service-overlay">
                            <div class="detail-header">
                                <h3 id="detail-title">{{ $firstService->title }}</h3>
                            </div>
                            <p id="detail-description">{{ $firstService->description }}</p>

                            <div class="detail-images-row">
                                @foreach($projects->take(3) as $project)
                                    @php
                                        $rawImage = !empty($project->images) ? $project->images[0] : null;
                                        $firstImage = is_array($rawImage) ? ($rawImage['value'] ?? null) : $rawImage;
                                    @endphp
                                    @if($firstImage)
                                        <div class="rounded-img"><img src="{{ Storage::url($firstImage) }}"
                                                alt="{{ $project->name }}"></div>
                                    @endif
                                @endforeach
                            </div>

                            <a href="#contacto" class="service-cta primary-glow" id="detail-button"
                                style="--item-color: #f97316; --item-glow: rgba(249, 115, 22, 0.4);">
                                <i class="{{ $firstService->icon ?? 'fa-solid fa-code' }}" id="btn-icon"></i>
                                <span id="btn-text">Saber más</span>
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
                <h2>{!! $projectsSectionTitle ?? 'Mis <span>Proyectos</span>' !!}</h2>
                <p>{{ $projectsSectionSubtitle ?? 'Una selección de mis trabajos más destacados, donde la arquitectura digital se encuentra con la precisión.' }}</p>
            </div>
            <div class="bento-grid">
                @php
                    $bentoLayouts = ['item-large', 'item-medium', 'item-small', 'item-small', 'item-wide', 'item-small', 'item-small'];
                @endphp
                @forelse($projects as $index => $project)
                    @php
                        $layoutClass = $bentoLayouts[$index % count($bentoLayouts)];
                        $rawImage = !empty($project->images) ? $project->images[0] : null;
                        $firstImage = is_array($rawImage) ? ($rawImage['value'] ?? null) : $rawImage;
                        $allImages = collect($project->images ?? [])->map(fn ($img) => is_array($img) ? ($img['value'] ?? null) : $img)->filter()->values();
                        $techs = collect($project->technologies ?? [])->map(function ($t) {
                            while (is_array($t) && isset($t['value'])) { $t = $t['value']; }
                            return is_array($t) ? '' : (string) $t;
                        })->filter()->values()->toArray();
                        $links = is_array($project->links) ? $project->links : [];
                    @endphp
                    <div class="bento-item {{ $layoutClass }} cursor-pointer"
                        onclick="openProjectModal(this)"
                        data-name="{{ $project->name }}"
                        data-description="{{ $project->description }}"
                        data-images="{{ $allImages->implode(',') }}"
                        data-techs="{{ implode(',', $techs) }}"
                        data-links="{{ json_encode($links) }}">
                        @if($firstImage)
                            <img src="{{ Storage::url($firstImage) }}" alt="{{ $project->name }} Showcase">
                        @endif
                        <div class="bento-overlay"></div>
                    </div>
                @empty
                    <div class="bento-item item-large">
                        <div class="bento-overlay">
                            <h3>Sin Proyectos</h3>
                            <p>Agrega proyectos desde tu dashboard y asígnalos a esta landing page.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Project Modal -->
            <div class="project-modal-overlay" id="projectModal">
                <div class="project-modal">
                    <button class="project-modal-close" onclick="closeProjectModal()"><i class="fa-solid fa-xmark"></i></button>
                    <div class="project-modal-gallery" id="modalGallery"></div>
                    <div class="project-modal-body">
                        <h3 id="modalTitle"></h3>
                        <p class="modal-desc" id="modalDesc"></p>
                        <div class="modal-techs" id="modalTechs"></div>
                        <div class="project-modal-links" id="modalLinks"></div>
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
                <h2>{!! $pricingSectionTitle ?? 'Mi oferta de <span>planes</span>' !!}</h2>
                <p>{{ $pricingSectionSubtitle ?? 'Checa mi tabla de precios y dime que te parece, mándame mensaje si buscas algo mas especifico para tu proyecto.' }}</p>
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
                            @if($plan->is_popular) style="background: linear-gradient(135deg, #f97316, #fb923c); box-shadow: 0 0 20px rgba(249, 115, 22, 0.4);" @endif
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
                    <h2>{!! $contactSectionTitle ?? '¿Hablamos por <span>Teléfono</span>?' !!}</h2>
                    <p>{{ $contactSectionSubtitle ?? 'Mi propuesta es simple: déjame tu número y agendamos una breve llamada para aterrizar tu proyecto y ver cómo puedo ayudarte.' }}</p>
                    <div class="info-items">
                        <div class="info-item">
                            <i class="fa-solid fa-calendar-check" style="color: #ffffff;"></i>
                            <span>{{ $contactListItem1 ?? 'Tú eliges el mejor momento' }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fa-solid fa-clock" style="color: #ffffff;"></i>
                            <span>{{ $contactListItem2 ?? 'Llamada de 10-15 minutos' }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fa-solid fa-bolt" style="color: #ffffff;"></i>
                            <span>{{ $contactListItem3 ?? 'Sin rodeos, directo al grano' }}</span>
                        </div>
                    </div>
                </div>
                <div class="contact-form-container">
                    <form id="multi-step-form" class="multi-step-form" action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div style="position: absolute; left: -9999px;" aria-hidden="true">
                            <input type="text" name="website" tabindex="-1" autocomplete="off">
                        </div>
                        <!-- Step 1: Phone or Email -->
                        <div class="form-step active" id="step-1">
                            <div class="form-group">
                                <label for="phone" id="contact-label">Tu número de teléfono</label>
                                <div style="display: flex; gap: 12px; align-items: center;">
                                    <div class="contact-toggle">
                                        <button type="button" class="toggle-option active" data-mode="phone">
                                            <i class="fa-solid fa-phone"></i>
                                        </button>
                                        <button type="button" class="toggle-option" data-mode="email">
                                            <i class="fa-solid fa-envelope"></i>
                                        </button>
                                    </div>
                                    <input type="tel" id="phone" name="phone" required placeholder="Ej. +52 123 456 7890"
                                        style="flex: 1; margin: 0;">
                                    <input type="email" id="email" name="email" placeholder="tu@correo.com"
                                        style="flex: 1; margin: 0; display: none;">
                                </div>
                            </div>
                            <button type="button" class="cta-button secondary-glass w-100 next-step mt-1" data-next="2"
                                style="margin-top: 1.5rem; border-color: #f97316 !important;">Agendar llamada</button>
                        </div>

                        <!-- Step 2: Date/Time -->
                        <div class="form-step" id="step-2">
                            <div class="form-group">
                                <label>¿Qué día te viene bien?</label>
                                <div class="date-options" id="date-options"></div>
                                <input type="hidden" id="date" name="date" required>
                            </div>
                            <div class="form-group" id="time-group" style="margin-top: 1.2rem; display: none;">
                                <label>¿A qué hora?</label>
                                <div id="time-toggle" style="display: none; gap: 8px; margin-bottom: 12px;">
                                    <div class="time-group-label" data-period="morning">Mañana</div>
                                    <div class="time-group-label" data-period="afternoon">Tarde</div>
                                </div>
                                <div class="time-groups" id="time-groups"></div>
                                <input type="hidden" id="time" name="time" required>
                            </div>
                            <div class="d-flex gap-1" style="margin-top: 1.5rem;">
                                <button type="button" class="cta-button secondary-glass prev-step"
                                    data-prev="1">Atrás</button>
                                <button type="button" class="cta-button secondary-glass w-100 next-step"
                                    data-next="3" style="border-color: #f97316 !important;">Siguiente</button>
                            </div>
                        </div>

                        <!-- Step 3: Name -->
                        <div class="form-step" id="step-3">
                            <div class="form-group">
                                <label for="full_name">¿Con quién tendré el gusto de hablar?</label>
                                <input type="text" id="full_name" name="name" required placeholder="Tu nombre completo">
                            </div>
                            <div class="d-flex gap-1" style="margin-top: 1.5rem;">
                                <button type="button" class="cta-button secondary-glass prev-step"
                                    data-prev="2">Atrás</button>
                                <button type="submit" class="cta-button w-100" style="background: linear-gradient(135deg, #f97316, #fb923c); border: none; box-shadow: 0 0 20px rgba(249, 115, 22, 0.4); color: white;">Confirmar cita</button>
                            </div>
                        </div>

                        <!-- Success Step -->
                        <div class="form-step" id="step-success">
                            <div class="success-content text-center">
                                <div class="success-icon"><i class="fa-solid fa-circle-check"></i></div>
                                <h3>¡Cita agendada!</h3>
                                <p>Recibirás un mensaje de confirmación pronto.</p>
                                <p id="confirm-message" style="margin-top: 1rem; color: rgba(255,255,255,0.8); font-size: 0.95rem;"></p>
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
                    const inputs = currentStep.querySelectorAll('input:not([type="hidden"]), select, textarea');
                    let isValid = true;
                    inputs.forEach(input => {
                        if (!input.checkValidity()) {
                            input.reportValidity();
                            isValid = false;
                        }
                    });

                    // Check hidden inputs (date/time)
                    if (isValid) {
                        const hiddenInputs = currentStep.querySelectorAll('input[type="hidden"][required]');
                        hiddenInputs.forEach(input => {
                            if (!input.value) {
                                isValid = false;
                                // Highlight the selector container
                                const container = input.previousElementSibling;
                                if (container) {
                                    container.style.border = '1px solid #ef4444';
                                    setTimeout(() => container.style.border = '', 2000);
                                }
                            }
                        });
                    }

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

                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.textContent;
                submitBtn.disabled = true;
                submitBtn.textContent = 'Enviando...';

                const formData = new FormData(form);

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (response.ok) {
                        // Build natural language confirmation
                        const dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
                        const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

                        const phoneVal = document.getElementById('phone').value;
                        const emailVal = document.getElementById('email').value;
                        const dateVal = document.getElementById('date').value;
                        const timeVal = document.getElementById('time').value;
                        const nameVal = document.getElementById('full_name').value;

                        const [year, month, day] = dateVal.split('-');
                        const dateObj = new Date(year, month - 1, day);
                        const diaSemana = dias[dateObj.getDay()];
                        const diaMes = parseInt(day);
                        const mes = meses[dateObj.getMonth()];

                        const [hours, minutes] = timeVal.split(':');
                        const h = parseInt(hours);
                        const ampm = h >= 12 ? 'de la tarde' : 'de la mañana';
                        const h12 = h > 12 ? h - 12 : (h === 0 ? 12 : h);
                        const horaNatural = minutes === '00'
                            ? `${h12} ${ampm}`
                            : `${h12}:${minutes} ${ampm}`;

                        const esTelefono = document.getElementById('phone').style.display !== 'none';
                        const contacto = esTelefono ? phoneVal : emailVal;
                        const tipoContacto = esTelefono ? 'al' : 'al correo';

                        const esc = (s) => s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
                        const msg = `¡Listo <strong>${esc(nameVal)}</strong>! Te contactaré ${tipoContacto} <strong>${esc(contacto)}</strong> para tener una charla el <strong>${diaSemana} ${diaMes} de ${mes}</strong> a las <strong>${horaNatural}</strong>.`;
                        document.getElementById('confirm-message').innerHTML = msg;

                        form.querySelector('.form-step.active').classList.remove('active');
                        document.getElementById('step-success').classList.add('active');
                    } else {
                        throw new Error('Error');
                    }
                } catch (error) {
                    alert('Hubo un error al procesar tu solicitud. Por favor intenta de nuevo.');
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                }
            });

            // Toggle phone/email
            const toggleBtns = document.querySelectorAll('.toggle-option');
            const phoneInput = document.getElementById('phone');
            const emailInput = document.getElementById('email');
            const contactLabel = document.getElementById('contact-label');

            toggleBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    toggleBtns.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    if (btn.dataset.mode === 'phone') {
                        phoneInput.style.display = '';
                        emailInput.style.display = 'none';
                        phoneInput.required = true;
                        emailInput.required = false;
                        emailInput.value = '';
                        contactLabel.textContent = 'Tu número de teléfono';
                    } else {
                        phoneInput.style.display = 'none';
                        emailInput.style.display = '';
                        phoneInput.required = false;
                        emailInput.required = true;
                        phoneInput.value = '';
                        contactLabel.textContent = 'Tu correo electrónico';
                    }
                });
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
                const isMobile = window.innerWidth <= 992;

                // Initial position at center
                const rect = section.getBoundingClientRect();
                let targetX = rect.width / 2;
                let targetY = rect.height / 2;
                let mouseX = targetX;
                let mouseY = targetY;

                // Position sphere at bottom-right on mobile
                if (isMobile) {
                    container.style.left = 'auto';
                    container.style.right = '-120px';
                    container.style.top = 'auto';
                    container.style.bottom = '-120px';
                    container.style.transform = 'none';
                    if (sphereGlow) {
                        sphereGlow.style.left = 'auto';
                        sphereGlow.style.right = '-120px';
                        sphereGlow.style.top = 'auto';
                        sphereGlow.style.bottom = '-120px';
                        sphereGlow.style.transform = 'none';
                    }
                }

                let isHoveringSelection = false;

                if (!isMobile) {
                    section.style.cursor = 'none';

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
                }

                // Animation loop
                let hoverTarget = 0;
                function animate(time) {
                    material.uniforms.uTime.value = time * 0.001;

                    if (!isMobile) {
                        // Smooth mouse follow (lerp)
                        mouseX += (targetX - mouseX) * 0.15;
                        mouseY += (targetY - mouseY) * 0.15;

                        // Direct position follow
                        container.style.left = `${mouseX}px`;
                        container.style.top = `${mouseY}px`;
                        if (sphereGlow) {
                            sphereGlow.style.left = `${mouseX}px`;
                            sphereGlow.style.top = `${mouseY}px`;
                        }
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
                            detailButton.style.setProperty('--item-text-color', item.getAttribute('data-text') || '#ffffff');

                            if (progress < 1) requestAnimationFrame(updateUniforms);
                        }
                        requestAnimationFrame(updateUniforms);

                        setTimeout(() => {
                            detailTitle.textContent = item.getAttribute('data-title');
                            detailDescription.textContent = item.getAttribute('data-description');

                            const btnIcon = document.getElementById('btn-icon');
                            const btnText = document.getElementById('btn-text');

                            if (btnIcon) btnIcon.className = item.getAttribute('data-icon');
                            if (btnText) btnText.textContent = item.getAttribute('data-btn-text');

                            detailOverlay.classList.remove('changing');
                        }, 300);
                    });
                });
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const dias = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
            const meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
            const dateContainer = document.getElementById('date-options');
            const dateInput = document.getElementById('date');
            const today = new Date();

            // Generate next 8 days (skip Sundays)
            for (let i = 1; i <= 21; i++) {
                const d = new Date(today);
                d.setDate(today.getDate() + i);
                if (d.getDay() === 0) continue; // Skip Sunday
                if (dateContainer.children.length >= 8) break;

                const dateStr = d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0') + '-' + String(d.getDate()).padStart(2, '0');
                const btn = document.createElement('div');
                btn.className = 'date-option';
                btn.dataset.date = dateStr;
                btn.innerHTML = `<div class="date-day">${dias[d.getDay()]}</div><div class="date-num">${d.getDate()}</div><div class="date-month">${meses[d.getMonth()]}</div>`;
                btn.addEventListener('click', function () {
                    dateContainer.querySelectorAll('.date-option').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    dateInput.value = this.dataset.date;
                    // Show time group and toggle, reset only the time slot (keep the period selected)
                    document.getElementById('time-group').style.display = '';
                    document.getElementById('time-toggle').style.display = 'flex';
                    timeContainer.querySelectorAll('.time-option').forEach(b => b.classList.remove('active'));
                    timeInput.value = '';
                    // If a period is still active, keep showing its options
                    const activePeriod = document.querySelector('#time-toggle .time-group-label.active');
                    if (activePeriod) {
                        const period = activePeriod.dataset.period;
                        timeContainer.querySelectorAll('.time-period').forEach(p => {
                            p.classList.toggle('active', p.dataset.period === period);
                        });
                    }
                });
                dateContainer.appendChild(btn);
            }

            // Time slots
            const timeGroups = [
                { label: 'Mañana', key: 'morning', hours: [9, 10, 11] },
                { label: 'Tarde', key: 'afternoon', hours: [14, 15, 16, 17] },
            ];
            const timeContainer = document.getElementById('time-groups');
            const timeInput = document.getElementById('time');

            timeGroups.forEach(group => {
                const period = document.createElement('div');
                period.className = 'time-period';
                period.dataset.period = group.key;

                const row = document.createElement('div');
                row.className = 'date-options';

                group.hours.forEach(h => {
                    const h12 = h > 12 ? h - 12 : h;
                    const ampm = h >= 12 ? 'pm' : 'am';
                    const timeStr = String(h).padStart(2, '0') + ':00';

                    const btn = document.createElement('div');
                    btn.className = 'time-option';
                    btn.dataset.time = timeStr;
                    btn.textContent = h12 + ampm;
                    btn.addEventListener('click', function () {
                        timeContainer.querySelectorAll('.time-option').forEach(b => b.classList.remove('active'));
                        this.classList.add('active');
                        timeInput.value = this.dataset.time;
                    });
                    row.appendChild(btn);
                });

                period.appendChild(row);
                timeContainer.appendChild(period);
            });

            // Time period toggle
            document.querySelectorAll('#time-toggle .time-group-label').forEach(label => {
                label.addEventListener('click', function () {
                    const period = this.dataset.period;
                    document.querySelectorAll('#time-toggle .time-group-label').forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                    timeContainer.querySelectorAll('.time-period').forEach(p => {
                        p.classList.toggle('active', p.dataset.period === period);
                    });
                    timeInput.value = '';
                });
            });
        });
    </script>

    <script>
        // Project Modal
        const linkIcons = {
            'website': 'fa-solid fa-globe',
            'github': 'fa-brands fa-github',
            'demo': 'fa-solid fa-arrow-up-right-from-square',
            'figma': 'fa-brands fa-figma',
            'npm': 'fa-brands fa-npm',
            'behance': 'fa-brands fa-behance',
            'other': 'fa-solid fa-link',
        };

        function openProjectModal(el) {
            const overlay = document.getElementById('projectModal');
            const name = el.dataset.name;
            const desc = el.dataset.description;
            const images = el.dataset.images ? el.dataset.images.split(',').filter(Boolean) : [];
            const techs = el.dataset.techs ? el.dataset.techs.split(',').filter(Boolean) : [];
            let links = [];
            try { links = JSON.parse(el.dataset.links || '[]'); } catch (e) {}

            document.getElementById('modalTitle').textContent = name;
            document.getElementById('modalDesc').textContent = desc;

            // Gallery
            const gallery = document.getElementById('modalGallery');
            gallery.innerHTML = '';
            images.forEach(src => {
                const img = document.createElement('img');
                img.src = '/storage/' + src;
                img.alt = name;
                gallery.appendChild(img);
            });

            // Techs
            const techsEl = document.getElementById('modalTechs');
            techsEl.innerHTML = '';
            techs.forEach(t => {
                const span = document.createElement('span');
                span.textContent = t;
                techsEl.appendChild(span);
            });

            // Links
            const linksEl = document.getElementById('modalLinks');
            linksEl.innerHTML = '';
            const linkLabels = {
                'behance': 'Ver proyecto en Behance',
            };
            links.forEach(link => {
                const a = document.createElement('a');
                a.href = link.url || '#';
                a.target = '_blank';
                a.rel = 'noopener';
                const icon = linkIcons[link.type] || 'fa-solid fa-link';
                const label = linkLabels[link.type] || null;
                if (label) {
                    a.innerHTML = '<i class="' + icon + '"></i><span>' + label + '</span>';
                    a.style.width = 'auto';
                    a.style.borderRadius = '50px';
                    a.style.padding = '0 16px';
                    a.style.gap = '8px';
                    a.style.fontSize = '0.8rem';
                    a.style.fontWeight = '500';
                    a.style.whiteSpace = 'nowrap';
                } else {
                    a.innerHTML = '<i class="' + icon + '"></i>';
                }
                a.title = (link.type || 'link').charAt(0).toUpperCase() + (link.type || 'link').slice(1);
                linksEl.appendChild(a);
            });

            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeProjectModal() {
            document.getElementById('projectModal').classList.remove('active');
            document.body.style.overflow = '';
        }

        document.getElementById('projectModal').addEventListener('click', function (e) {
            if (e.target === this) closeProjectModal();
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeProjectModal();
        });
    </script>
</body>

</html>
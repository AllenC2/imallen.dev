<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-gtm-head />
    <meta name="description"
        content="{{ $landingPage->meta_description ?? 'Aprovecha nuestras promociones exclusivas de Semana Santa en desarrollo de software.' }}">
    <title>{{ $landingPage->meta_title ?? ($landingPage->title ?? 'Promociones Semana Santa') }}</title>
    <!-- Modern typography for premium feel -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Small overrides for Easter theme if needed, otherwise rely on the base styles */
        .glass-hero {
            background: rgba(50, 20, 80, 0.4);
        }

        /* Deeper purple for easter */
        .purple-blob {
            background: linear-gradient(to right, #9c27b0, #03a9f4);
        }

        .orange-blob {
            background: linear-gradient(to right, #ff9800, #e91e63);
        }

        /* Easter promo banner */
        .promo-banner {
            background: linear-gradient(90deg, #ff007f, #7928ca);
            color: #fff;
            text-align: center;
            padding: 10px;
            font-weight: 600;
            position: relative;
            z-index: 1000;
            font-size: 0.9rem;
            letter-spacing: 1px;
        }
    </style>
</head>

<body>
    <x-gtm-body />
    <div class="promo-banner">
        🐣 ¡ESPECIAL SEMANA SANTA! HASTA 30% DE DESCUENTO EN TODOS LOS PLANES 🐣
    </div>

    <section class="hero glass-hero">
        <div class="hero-content">
            <h1 class="hero-title">Promociones de <span>Semana Santa</span></h1>
            <p class="hero-subtitle">Aprovecha nuestros descuentos especiales en desarrollo web y software a la medida
                durante esta temporada vacacional. ¡Digitaliza tu negocio hoy y prepárate para crecer!</p>
            <div class="hero-actions">
                <button class="cta-button primary-glow">Reclamar Descuento</button>
                <button class="cta-button secondary-glass">Ver Servicios</button>
            </div>
        </div>

        <div class="hero-carousel-wrapper">
            <!-- Decorative blurred background shapes -->
            <div class="blur-blob purple-blob"></div>
            <div class="blur-blob orange-blob"></div>

            <div class="hero-carousel dual-carousel">
                <div class="carousel-container column-left">
                    <div class="carousel-track track-up" id="track-1">
                        <!-- Clones and original will be JS generated -->
                    </div>
                </div>
                <div class="carousel-container column-right">
                    <div class="carousel-track track-down" id="track-2">
                        <!-- Clones and original will be JS generated -->
                    </div>
                </div>

                <!-- Glassmorphism overlay gradients to fade edges of carousel nicely -->
                <div class="fade-top"></div>
                <div class="fade-bottom"></div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services section-padding">
        <div class="container">
            <div class="section-title text-center">
                <h2>Servicios en <span>Oferta</span></h2>
                <p>Nuestros servicios estrella, ahora y solo por tiempo limitado, con descuentos especiales de
                    temporada.</p>
            </div>
            <div class="services-grid">
                @forelse($services as $service)
                    <div class="service-card glass-card {{ $service->color_class ?? 'hover-glow-purple' }}">
                        <div class="service-icon"><i class="{{ $service->icon ?? 'fa-solid fa-code' }}"></i></div>
                        <h3>{{ $service->title }}</h3>
                        <p>{{ $service->description }}</p>
                    </div>
                @empty
                    <div class="service-card glass-card hover-glow-purple">
                        <div class="service-icon"><i class="fa-solid fa-code"></i></div>
                        <h3>Servicios listos</h3>
                        <p>Agrega servicios desde tu nuevo panel de administrador.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing section-padding dark-bg relative">
        <div class="blur-blob purple-blob small-blob right-center"></div>
        <div class="container relative-z">
            <div class="section-title text-center">
                <h2>Planes <span>Especiales</span></h2>
                <p>Elige tu plan y obtén hasta un 30% de descuento automático en tu primera mensualidad.</p>
            </div>
            <div class="pricing-grid">
                @forelse($plans as $plan)
                    <div class="pricing-card glass-card {{ $plan->is_popular ? 'popular highlight-border' : '' }}">
                        @if($plan->badge)
                            <div class="badge">{{ $plan->badge }}</div>
                        @elseif($plan->discount_percentage)
                            <div class="badge" style="background: #e91e63;">-{{ $plan->discount_percentage }}% HOY</div>
                        @endif
                        <h3>{{ $plan->name }}</h3>
                        
                        @if($plan->discount_percentage)
                            <!-- Discount promo strikethrough price -->
                            <div style="text-decoration: line-through; color: #aaa; font-size: 1.2rem; margin-bottom: -10px;">
                                ${{ number_format($plan->price, 0) }}
                            </div>
                            <div class="price"><span>$</span>{{ number_format($plan->price * (1 - ($plan->discount_percentage / 100)), 0) }}<span>/mes</span></div>
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
                        <button
                            class="cta-button {{ $plan->is_popular ? 'primary-glow' : 'secondary-glass' }} w-100">{{ $plan->button_text }}</button>
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
    <section class="contact section-padding dark-bg relative">
        <div class="blur-blob orange-blob small-blob left-bottom"></div>
        <div class="container relative-z">
            <div class="contact-wrapper">
                <div class="contact-info">
                    <h2>Haz Valida Tu <span>Promoción</span></h2>
                    <p>Déjanos tus datos, cuéntanos sobre tu proyecto y reclamaremos tu descuento de Semana Santa al
                        momento de contactarte.</p>
                    <div class="info-items">
                        <div class="info-item">
                            <i class="fa-solid fa-envelope"></i>
                            <span>hola@techstudio.com</span>
                        </div>
                        <div class="info-item">
                            <i class="fa-solid fa-phone"></i>
                            <span>+52 (123) 456-7890</span>
                        </div>
                        <div class="info-item">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>Ciudad de México, CP 11000</span>
                        </div>
                    </div>
                </div>
                <div class="contact-form-container glass-card strong-glass">
                    <form id="contact-form" class="contact-form" action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre Completo</label>
                            <input type="text" id="name" name="name" required placeholder="Ej. Juan Pérez">
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" id="email" name="email" required placeholder="juan@empresa.com">
                        </div>
                        <div class="form-group">
                            <label for="service">Servicio de Interés</label>
                            <div class="custom-select-wrapper">
                                <select id="service" name="service_interest" required>
                                    <option value="" disabled selected>Selecciona una opción</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->title }}">{{ $service->title }}</option>
                                    @endforeach
                                    <option value="Otro">Otro</option>
                                </select>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Mensaje sobre tu proyecto</label>
                            <textarea id="message" name="message" required rows="4"
                                placeholder="Describe brevemente tus requerimientos..."></textarea>
                        </div>
                        <button type="submit" class="cta-button primary-glow w-100">Enviar Mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>&copy; 2026 TechStudio. Ofertas aplicables solo durante el periodo vacacional.</p>
            <div class="social-links mt-1">
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                <a href="#"><i class="fa-brands fa-github"></i></a>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-gtm-head />
    <meta name="description"
        content="{{ $landingPage->meta_description ?? 'A landing page featuring stunning vertical scroll effects and modern design.' }}">
    <title>{{ $landingPage->meta_title ?? ($landingPage->title ?? 'Hero - Scroll Experience') }}</title>
    <!-- Modern typography for premium feel -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <x-gtm-body />

    <!-- Header -->
    <header
        style="padding: 2rem 5%; width: 100%; max-width: 1400px; margin: 0 auto; position: absolute; top: 0; left: 0; right: 0; z-index: 100; display: flex; justify-content: center; align-items: center;">
        <a href="/">
            <!-- Inline SVG Logo -->
            <svg style="height: 30px;" viewBox="0 0 380 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M5.14258 19.0713H13.4404V63.0713H0V0.959961H8.9375L5.14258 19.0713ZM36.3496 0C41.0216 0 44.35 1.53542 46.334 4.60742C48.19 1.53562 51.5176 6.26624e-05 56.3174 0H63.4219C71.3577 7.03886e-05 75.3262 4.22395 75.3262 12.6719V63.0713H61.8857V11.5195C61.8857 11.0076 61.6935 10.5598 61.3096 10.1758C60.9896 9.79178 60.5735 9.59961 60.0615 9.59961H54.8779C54.3659 9.59961 53.9172 9.79178 53.5332 10.1758C53.2134 10.5597 53.0537 11.0077 53.0537 11.5195V63.0713H39.6133V11.5195C39.6133 11.0077 39.4219 10.5597 39.0381 10.1758C38.7182 9.79187 38.3019 9.5997 37.79 9.59961H32.6055C32.0936 9.59966 31.6457 9.79183 31.2617 10.1758C30.9418 10.5597 30.7812 11.0076 30.7812 11.5195V63.0713H17.3418V12.6719C17.3418 4.22388 21.3101 0 29.2461 0H36.3496ZM106.234 0C114.17 0 118.139 4.22388 118.139 12.6719V63.0713H104.698V42.2393H95.0029V63.0713H81.5625V12.6719C81.5625 4.22388 85.5308 0 93.4668 0H106.234ZM137.597 51.7432H152.284V63.0713H124.156V0.959961H137.597V51.7432ZM171.097 51.7432H185.784V63.0713H157.656V0.959961H171.097V51.7432ZM218.477 11.9033H203.597V26.4951H217.517V37.0557H203.597V51.9355H218.477V63.0713H190.156V0.959961H218.477V11.9033ZM247.962 0C255.898 0 259.866 4.22388 259.866 12.6719V50.293C258.69 50.5934 257.645 51.1999 256.731 52.1133C255.371 53.4743 254.69 55.127 254.69 57.0713C254.69 59.0156 255.371 60.6683 256.731 62.0293C257.141 62.4384 257.577 62.7851 258.039 63.0713H246.426V11.5195C246.426 11.0077 246.234 10.5597 245.851 10.1758C245.531 9.79187 245.114 9.5997 244.603 9.59961H239.418C238.906 9.59966 238.458 9.79183 238.074 10.1758C237.754 10.5597 237.594 11.0076 237.594 11.5195V63.0713H224.154V12.6719C224.154 4.22388 228.123 0 236.059 0H247.962ZM333.83 11.9033H318.95V26.4951H332.87V37.0557H318.95V51.9355H343.83L345.83 63.0713H305.51V0.959961H333.83V11.9033ZM359.076 46.2715L366.66 0.959961H379.62L366.756 63.0713H351.3L338.436 0.959961H351.492L359.076 46.2715ZM288.588 0.959961C296.524 0.959961 300.492 5.18384 300.492 13.6318V50.3994C300.492 58.8474 296.524 63.0713 288.588 63.0713H265.342C265.803 62.7852 266.239 62.4383 266.648 62.0293C268.009 60.6682 268.69 59.0157 268.69 57.0713C268.69 55.1269 268.009 53.4744 266.648 52.1133C265.841 51.3054 264.929 50.7385 263.916 50.4102V0.959961H288.588ZM277.356 53.8555H285.229C285.74 53.8554 286.157 53.6632 286.477 53.2793C286.86 52.8954 287.052 52.4474 287.052 51.9355V11.999C287.052 11.4872 286.86 11.0391 286.477 10.6553C286.157 10.2713 285.74 10.0792 285.229 10.0791H277.356V53.8555ZM96.8271 9.11914C96.3151 9.11914 95.8664 9.31131 95.4824 9.69531C95.1625 10.0792 95.003 10.5273 95.0029 11.0391V31.8711H104.698V11.0391C104.698 10.5273 104.507 10.0792 104.123 9.69531C103.803 9.31139 103.387 9.11922 102.875 9.11914H96.8271Z"
                    fill="white" />
            </svg>
        </a>
    </header>

    <section class="hero glass-hero">
        <div class="hero-content">
            <h1 class="hero-title">La IA nunca fue <span>suficiente.</span></h1>
            <p class="hero-subtitle">Que ya no te sigan contando de promts magicos, la ia es una herramienta poderosa
                pero las grandes ideas necesitan mas que un sitio al azar.</p>
            <div class="hero-actions">
                <button class="cta-button primary-glow">Empezar Ahora</button>
                <button class="cta-button secondary-glass">Saber Más</button>
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
                <h2>No es dificil hacer las cosas <span>bien.</span></h2>
                <p>Todos mis desarrollos cumplen con lo que hoy en dia deberian ser el estandar de la web.</p>
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
                <h2>Mi oferta de <span>planes</span></h2>
                <p>Checa mi tabla de precios y dime que te parece, mandame mensaje si buscas algo mas especifico para tu
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

    <!-- FAQ Section -->
    <section class="faq section-padding">
        <div class="container max-w-lg">
            <div class="section-title text-center">
                <h2>Preguntas <span>Frecuentes</span></h2>
                <p>Resolvemos tus dudas sobre nuestro proceso de trabajo.</p>
            </div>
            <div class="faq-list">
                @forelse($faqs as $faq)
                    <div class="faq-item glass-card">
                        <div class="faq-question">
                            <h4>{{ $faq->question }}</h4>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>{{ $faq->answer }}</p>
                        </div>
                    </div>
                @empty
                    <div class="faq-item glass-card">
                        <div class="faq-question">
                            <h4>¿Aún no tienes preguntas frecuentes?</h4>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Visita el panel de administración (/admin) para empezar a crear tus propias preguntas y
                                respuestas.</p>
                        </div>
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
                    <h2>Comienza tu <span>Transformación</span> Digital</h2>
                    <p>Cuéntanos sobre tu proyecto y nuestro equipo de expertos se pondrá en contacto contigo en menos
                        de 24 horas.</p>
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

    <script src="script.js"></script>
</body>

</html>
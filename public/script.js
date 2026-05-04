document.addEventListener("DOMContentLoaded", () => {
    // ---- HERO SCROLL-LINKED CAROUSEL LOGIC ----
    const track1 = document.getElementById("track-1");
    const track2 = document.getElementById("track-2");
    const imgSource = "./carousel-image.png";

    // Generate slides for each track
    function createSlides(track, count) {
        for (let i = 0; i < count; i++) {
            const slide = document.createElement("div");
            slide.classList.add("slide");
            const img = document.createElement("img");
            img.src = imgSource;
            img.alt = "Abstract Shape";
            slide.appendChild(img);
            track.appendChild(slide);
        }
    }

    // Creating initial slides, many of them so we can scroll for a while
    const numSlides = 15;
    createSlides(track1, numSlides);
    createSlides(track2, numSlides);

    // Initial setups for scroll:
    // Left column scroll down (track going up), Right column scroll up (track going down)

    // Initial offset so right track can go down without hitting empty space immediately
    let t1offset = 0;
    let t2offset = -1000;   // start right track high (using pixels roughly)

    // Adjusting based on window height
    function getScrollValues() {
        const scrollY = window.scrollY;

        // Track 1 moves UP as you scroll down
        const track1Transform = -scrollY * 0.8;

        // Track 2 moves DOWN as you scroll down
        // We start it deeply negative so it has room to translate downwards
        const track2Base = -(track2.scrollHeight / 2); // Start halfway up roughly
        const track2Transform = track2Base + (scrollY * 0.8);

        track1.style.transform = `translateY(${track1Transform}px)`;
        track2.style.transform = `translateY(${track2Transform}px)`;
    }

    window.addEventListener('scroll', () => {
        requestAnimationFrame(getScrollValues);
    });

    // Call once to set initial state
    setTimeout(getScrollValues, 100);

    // ---- FAQ ACCORDION LOGIC ----
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        item.addEventListener('click', () => {
            const isActive = item.classList.contains('active');

            // Close all
            faqItems.forEach(faq => faq.classList.remove('active'));

            // Open clicked if it wasn't already open
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });

    // ---- FORM SUBMIT AJAX LOGIC ----
    const form = document.getElementById('contact-form');
    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = form.querySelector('button[type="submit"]');
            const originalText = btn.innerHTML;

            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Enviando...';
            btn.disabled = true;

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
                    btn.innerHTML = '<i class="fa-solid fa-check"></i> Mensaje Enviado!';
                    btn.classList.remove('primary-glow');
                    btn.style.background = '#10b981'; // Success green
                    form.reset();

                    setTimeout(() => {
                        btn.innerHTML = originalText;
                        btn.classList.add('primary-glow');
                        btn.style.background = '';
                        btn.disabled = false;
                    }, 3000);
                } else {
                    throw new Error("Network error");
                }
            } catch (error) {
                btn.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Error al enviar';
                btn.classList.remove('primary-glow');
                btn.style.background = '#ef4444'; // Error red

                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.classList.add('primary-glow');
                    btn.style.background = '';
                    btn.disabled = false;
                }, 3000);
            }
        });
    }
});

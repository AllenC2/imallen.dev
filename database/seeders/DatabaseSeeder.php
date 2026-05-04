<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Plan;
use App\Models\Faq;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Service::create([
            'title' => 'Desarrollo Web Custom',
            'description' => 'Aplicaciones web escalables, rápidas y seguras creadas desde cero adaptadas a tus necesidades específicas.',
            'icon' => 'fa-solid fa-code',
            'color_class' => 'hover-glow-purple'
        ]);

        Service::create([
            'title' => 'Apps Móviles',
            'description' => 'Experiencias nativas e híbridas para iOS y Android con diseños intuitivos y alto rendimiento.',
            'icon' => 'fa-solid fa-mobile-screen-button',
            'color_class' => 'hover-glow-orange'
        ]);

        Service::create([
            'title' => 'Cloud Architecture',
            'description' => 'Migración, optimización y diseño de arquitecturas cloud robustas para máxima disponibilidad.',
            'icon' => 'fa-solid fa-cloud',
            'color_class' => 'hover-glow-purple'
        ]);

        Service::create([
            'title' => 'Integración de IA',
            'description' => 'Automatización de procesos y potenciación de productos con soluciones de inteligencia artificial de última generación.',
            'icon' => 'fa-solid fa-robot',
            'color_class' => 'hover-glow-orange'
        ]);

        $startup = Plan::create([
            'name' => 'Startup',
            'price' => 999,
            'is_popular' => false,
        ]);
        $startup->features()->createMany([
            ['name' => 'Desarrollo de MVP', 'is_included' => true],
            ['name' => 'Soporte Básico', 'is_included' => true],
            ['name' => '1 Iteración mensual', 'is_included' => true],
            ['name' => 'Consultoría Cloud', 'is_included' => false],
        ]);

        $business = Plan::create([
            'name' => 'Business',
            'price' => 2499,
            'is_popular' => true,
            'badge' => 'Más Popular',
        ]);
        $business->features()->createMany([
            ['name' => 'Desarrollo Full-Stack', 'is_included' => true],
            ['name' => 'Soporte Prioritario 24/7', 'is_included' => true],
            ['name' => 'Iteraciones ilimitadas', 'is_included' => true],
            ['name' => 'Integración Básica IA', 'is_included' => true],
        ]);

        $enterprise = Plan::create([
            'name' => 'Enterprise',
            'price' => 4999,
            'is_popular' => false,
            'button_text' => 'Contactar Ventas'
        ]);
        $enterprise->features()->createMany([
            ['name' => 'Equipo Dedicado', 'is_included' => true],
            ['name' => 'Arquitectura Cloud Custom', 'is_included' => true],
            ['name' => 'IA Avanzada', 'is_included' => true],
            ['name' => 'SLAs Garantizados', 'is_included' => true],
        ]);

        $faqs = [
            [
                'question' => '¿Cuál es el tiempo estimado de entrega de un proyecto?',
                'answer' => 'El tiempo depende de la complejidad del proyecto. Un MVP (Producto Mínimo Viable) suele tomar entre 4 a 8 semanas, mientras que plataformas más complejas pueden llevar de 3 a 6 meses.'
            ],
            [
                'question' => '¿Trabajan con metodologías ágiles?',
                'answer' => 'Sí, utilizamos sprints de 2 semanas basados en la metodología Scrum para asegurar entregas continuas y permitir adaptabilidad a cambios durante el proceso de desarrollo.'
            ],
            [
                'question' => '¿El código fuente es de mi propiedad?',
                'answer' => 'Absolutamente. Una vez finalizado el proyecto y cubiertos los pagos correspondientes, se realiza la entrega completa y transferencia de propiedad de todo el código desarrollado.'
            ],
            [
                'question' => '¿Ofrecen soporte y mantenimiento post-lanzamiento?',
                'answer' => 'Sí, todos nuestros proyectos incluyen un mes gratis de soporte post-lanzamiento para corrección de bugs. Posterior a eso, ofrecemos pólizas de mantenimiento continuo a la medida.'
            ]
        ];

        foreach ($faqs as $i => $faq) {
            Faq::create([...$faq, 'sort_order' => $i]);
        }
    }
}

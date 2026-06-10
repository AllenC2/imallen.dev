<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Plan;
use App\Models\Faq;
use App\Models\Contact;
use App\Models\LandingPage;

class HomeController extends Controller
{
    public function index()
    {
        $landingPage = LandingPage::where('is_default_root', true)->first();

        // Si no hay landing configurada como root, buscamos si existe alguna cualquiera. Si no, $landingPage será null.
        if (!$landingPage) {
            $landingPage = LandingPage::first();
        }

        return $this->renderLandingPage($landingPage);
    }

    public function show($slug)
    {
        $landingPage = LandingPage::where('slug', $slug)->firstOrFail();

        return $this->renderLandingPage($landingPage);
    }

    protected function renderLandingPage(?LandingPage $landingPage)
    {
        $services = $landingPage ? $landingPage->services()->orderBy('landing_page_service.sort_order')->get() : collect();
        $plans = Plan::with('features')->get();
        $faqs = Faq::orderBy('sort_order')->get();
        $projects = $landingPage ? $landingPage->projects()->orderBy('landing_page_project.sort_order')->get() : collect();

        $viewName = $landingPage && $landingPage->view_file ? $landingPage->view_file : 'landing-pages.welcome';

        if ($landingPage) {
            $landingPage->increment('visits');
        }

        $templateVars = $landingPage ? ($landingPage->variables ?? []) : [];

        return view($viewName, compact('services', 'plans', 'faqs', 'projects', 'landingPage') + $templateVars);
    }

    public function storeContact(Request $request)
    {
        // Honeypot: si tiene contenido, es un bot
        if ($request->filled('website')) {
            return response()->json(['success' => true]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'date' => 'nullable|string|max:50',
            'time' => 'nullable|string|max:50',
            'service_interest' => 'nullable|string',
            'message' => 'nullable|string',
        ]);

        Contact::create($validated);

        return response()->json(['success' => true]);
    }
}

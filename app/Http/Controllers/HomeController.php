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
        $services = Service::all();
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'service_interest' => 'nullable|string',
            'message' => 'required|string'
        ]);

        Contact::create($validated);

        return response()->json(['success' => true]);
    }
}

<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GtmHead extends Component
{
    public $gtmId;
    public $isActive;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->gtmId = \App\Models\Setting::val('gtm_id', 'GTM-XXXXXXX');
        $this->isActive = \App\Models\Setting::val('is_gtm_active', '0') === '1';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gtm-head');
    }
}

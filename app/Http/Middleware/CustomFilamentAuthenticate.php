<?php

namespace App\Http\Middleware;

use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate as FilamentAuthenticate;

class CustomFilamentAuthenticate extends FilamentAuthenticate
{
    protected function redirectTo($request): ?string
    {
        return route('login');
    }

    /**
     * @param  array<string>  $guards
     */
    protected function authenticate($request, array $guards): void
    {
        $guard = Filament::auth();

        if (! $guard->check()) {
            $this->unauthenticated($request, $guards);

            return;
        }

        $this->auth->shouldUse(Filament::getAuthGuard());

        $user = $guard->user();

        $panel = Filament::getCurrentPanel();

        if (! $user->canAccessPanel($panel)) {
            abort(redirect()->route('portal.index'));
        }
    }
}

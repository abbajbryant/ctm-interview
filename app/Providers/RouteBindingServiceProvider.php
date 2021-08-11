<?php

namespace App\Providers;

use mmghv\LumenRouteBinding\RouteBindingServiceProvider as BaseProvider;
use App\Models\User;

class RouteBindingServiceProvider extends BaseProvider
{
    public function boot(): void
    {
        $this->binder
            ->bind('user', User::class);
    }
}

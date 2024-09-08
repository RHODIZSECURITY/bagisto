<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class RedirectToNonWwwMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (substr($request->header('host'), 0, 4) == 'www.') {

            if (str_contains($request->header('host'), 'tienda.rhodiz.net')) {
                $request->headers->set('host', 'tienda.rhodiz.net');
            }

            return Redirect::to($request->path(),301);
        }

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        return $next($request);
    }
}

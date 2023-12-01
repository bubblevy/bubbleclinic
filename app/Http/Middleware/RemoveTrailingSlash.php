<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RemoveTrailingSlash
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $path = $request->getPathInfo();

        if (substr($path, -1) === '/' && $path !== '/') {
            $path = rtrim($path, '/');
            return redirect($path, 301);
        }
        return $next($request);
    }
}

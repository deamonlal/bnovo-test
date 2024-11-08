<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AddDebugHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $startTime = microtime(true);

        $response = $next($request);

        $executionTime = (microtime(true) - $startTime) * 1000; // миллисекунды

        $memoryUsage = memory_get_usage(true) / 1024; // Кб

        $response->headers->set('X-Debug-Time', round($executionTime));
        $response->headers->set('X-Debug-Memory', round($memoryUsage));

        return $response;
    }
}

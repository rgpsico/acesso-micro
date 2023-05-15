<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Host
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $RequestHost = parse_url(\Illuminate\Support\Facades\URL::full())['host'];
        $AcceptedHost = explode(',', env('ACCEPTED_HOST'));

        if (in_array($RequestHost, $AcceptedHost) == true || $RequestHost == 'localhost') {
            return $next($request);
        } else {
            abort(403);
        }
    }
}

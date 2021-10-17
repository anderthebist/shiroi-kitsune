<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NullableRequest
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
        foreach ($request->input() as $key => $value) {
            if (empty($value)) {
                $request->request->set($key, null);
            }
        }

        return $next($request);
    }
}

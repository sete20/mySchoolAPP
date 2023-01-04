<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AssistantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->user_type === 'assistant' || auth()->user()->user_type === 'teacher') {
            return $next($request);
        }
        abort(403);
    }
}

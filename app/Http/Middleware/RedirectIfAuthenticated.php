<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
public function handle(Request $request, Closure $next, ...$guards)
{
    // 1. Ưu tiên số 1: Nếu là request vào Admin, cho đi tiếp luôn
    if ($request->is('admin') || $request->is('admin/*')) {
        return $next($request);
    }

    // 2. Ưu tiên số 2: Nếu đã có session 'admin', tuyệt đối không đá về /home
    if ($request->session()->has('admin')) {
        return $next($request);
    }

    $guards = empty($guards) ? [null] : $guards;
    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::HOME);
        }
    }

    return $next($request);
}
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class AdminMiddleware
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
    // Kiểm tra xem trong Session có tồn tại key 'admin' hay không
    if (!$request->session()->has('admin')) 
    {
        // Nếu không có, gửi thông báo qua flash session và quay về trang login admin
        return redirect()->route('admin.login')->with('error', 'Vui lòng đăng nhập quyền quản trị để tiếp tục.');
    }

    // Nếu có session 'admin', cho phép đi tiếp vào trang Dashboard/Tours...
    return $next($request);
}
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginClient
{
    
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Kiểm tra xem trong Session có tồn tại 'userId' hay không
    if (!session()->has('userId')) {
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để đặt tours!');
    }

    // 3. Nếu đã đăng nhập, cho phép đi tiếp đến Controller
    return $next($request);
        
    }
}

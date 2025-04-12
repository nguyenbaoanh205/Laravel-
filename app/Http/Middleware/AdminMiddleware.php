<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // sử dụng auth để check đã đăng nhập hay chưa
        if (!Auth::check()) { // chưa xác thực
            return redirect('/login');
        }

        // check phâm quyền của admin
        if (Auth::user()->role !== 'admin') {
            return redirect('/list') -> with('error', 'Khong co quyen truy cap');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            //return redirect(RouteServiceProvider::HOME);
            $role = Auth::user()->role;
            switch($role)
            {
                case 'admin': return 'admin/books';
                    break;
                case 'karyawan': return 'admin/book_category';
                    break;
                case 'member': return '/home';
                    break;
                default: return '/catalog';
                    break;
            }
        }
        return $next($request);
    }
}

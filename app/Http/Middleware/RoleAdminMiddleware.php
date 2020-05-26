<?php

namespace App\Http\Middleware;

use App\Access;
use Closure;
use Illuminate\Support\Facades\Auth;

class RoleAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Access::where(['role_id' => Auth::user()->role_id, 'menu_id' => 2])->exists() == false) {
            return view('block');
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class User
{
    public function handle(Request $request, Closure $next): Response
    {
        if(!session()->get('id_user')){
            return to_route('signin');
        }
        return $next($request);
    }
}

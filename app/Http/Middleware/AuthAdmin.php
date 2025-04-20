<?php



namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->Utype != 'ADM') {
            session()->flush();
            return redirect()->route('login');
        }


        return $next($request);
    }
}

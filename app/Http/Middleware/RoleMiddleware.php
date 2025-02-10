<?php



namespace App\Http\Middleware;



use Closure;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;



class RoleMiddleware

{

    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check()) {
            if (Auth::user()->role === $role) {
                return $next($request);
            }

            // Debugging: Log invalid role
            return redirect('home')->withErrors(['error' => 'Unauthorized role: ' . Auth::user()->role]);
        }

        return redirect('login')->withErrors(['error' => 'User not authenticated']);
    }

}


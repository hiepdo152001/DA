<?php

namespace App\Http\Middleware;

use App\Models\roles;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
{
    if ($request->user()) {
        $userRole = roles::where('id', $request->user()->role_id)->value('name');
        if (in_array($userRole, $roles)) {
            return $next($request);
        }
    }
    
    return redirect('/login');
}
}

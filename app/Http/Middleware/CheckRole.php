<?php

namespace App\Http\Middleware;

use App\Models\roles;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {

        if ($request->user() ) {
            $roles=roles::where('id',$request->user()->role_id)->value('name');
            if($roles===$role){
                return $next($request);
            }
        }
        return redirect()->intended('/home');
    }
}

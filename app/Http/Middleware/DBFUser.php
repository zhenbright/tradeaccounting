<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class DBFUser
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

        if ($request->session()->has('userid')) {
            return $next($request);
        }
        return redirect('/home');
    }
}

<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Session;

class Lenguaje
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
        if(Session::has('locale')){
            $locale = Session::get('locale', config('app.locale'));
        }else{
            $locale = 'en';
        }
        App::setlocale($locale);
        return $next($request);
    }
}

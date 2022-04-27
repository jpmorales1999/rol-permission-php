<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
      /** 
       *  @Access-Control-Allow-Origin
       * Establece cuales son los orígenes de las peticiones que 
       * podrán utilizar los recursos mediante la cabecera.
       * 
       * El * representa a todos los orígenes.
       * 
       * @Access-Control-Allow-Methods 
       * Determina que métodos HTTP son aceptados para estas peticiones.
       */
      $request->header('Access-Control-Allow-Origin', '*');
      $request->header('Access-Control-Allow-Methods', 'GET, POST');
      $request->header('Access-Control-Allow-Headers', 'Content-Type,
      Authorization');
      return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class cors
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
        header("Access-Control-Allow-Origin: *");
        //Allow Method Options
        $headers = [
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Authorization',
        ];

        if($request->getMethod() == "OPTIONS"){
            //client-side application can set only headers allowed in Access-Control-Allow-Headers
            return response()->json('OK',200, $headers);
        }
        $response = $next($request);
        foreach ($headers as $key => $value){
            $response->header($key, $value);
        }
        return $response;

    }
}

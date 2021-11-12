<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class checkAdmin
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
        try {
            $roles = auth()->guard('api')->user()->roles()->pluck('role_name')->toArray();

            if(in_array('admin', $roles))
            {
                return $next($request);
            }

            $message = "invalid user";
            Log::info("invalid user : ".json_encode($request->all()));

        } catch (\Exception $exception)
        {
            $message = $exception->getMessage();
            Log::info(" admin middleware exception : ".json_encode($exception->getMessage()));
        }


        return response()->json(['message' => $message ], 401);

    }
}

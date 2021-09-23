<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if($request->expectsJson()){
            if($request->user() && $request->user()->role==='admin'){
                return $next($request);
            }
            else{
                $returnObj =array();
                $returnObj['message']="You're not admin!";
                $returnObj['statusCode']=401;
                return response()->json($returnObj);
            }
        }
        return $next($request);
    }
}

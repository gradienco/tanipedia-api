<?php 

namespace App\Http\Middleware;

class CorsMiddleware {
    public function handle($request, \Closure $next) {
        $headers = [
            'Access-Control-Allow-Origin'      => '*',
            'Access-Control-Allow-Methods'     => 'HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age'           => '86400',
            'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With, APP-KEY'
        ];

        if ($request->isMethod('OPTIONS'))
            return response()->json('{"method":"OPTIONS"}', 200, $headers);

        $response = $next($request);
        foreach($headers as $key => $value)
            $response->header($key, $value);
        
        if($request->header('APP-KEY')) 
            if($request->header('APP-KEY') == env("APP_KEY")) 
                return $response;

        return response()->json([
            'status' => "ERROR",
            'message' => "Unauthorized Client"
        ], 403);
    }
}


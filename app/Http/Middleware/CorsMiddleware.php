<?php 

namespace App\Http\Middleware;

class CorsMiddleware {
    public function handle($request, \Closure $next) {
        if($request->header('APP-KEY')) {
            if($request->header('APP-KEY') == env("APP_KEY")) {
                $response = $next($request);
                $response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE');
                $response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
                $response->header('Access-Control-Allow-Origin', '*');
                return $response;
            }
        }
        return response()->json([
            'status' => "ERROR",
            'message' => "Unauthorized Client"
        ], 403);
    }
}


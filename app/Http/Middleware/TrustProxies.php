<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;
use Closure;

class TrustProxies extends Middleware
{
    protected $headers = Request::HEADER_X_FORWARDED_AWS_ELB;

    public function handle($request, Closure $next)
    {
        ini_set('post_max_size', '50M');
        ini_set('upload_max_filesize', '50M');

        return $next($request);
    }
}

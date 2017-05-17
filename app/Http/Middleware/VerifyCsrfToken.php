<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Illuminate\Session\TokenMismatchException;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    public function handle($request, Closure $next)
    {
        if ($this->isReading($request) || $this->tokensMatch($request))
        {
            return $this->addCookieToResponse($request, $next($request));
        }
        if($request->ajax())
        {
            return response()->json([
                'status'=>false,
                'errors' => ["Token expirado, recargue la página"
                ]]);
        }
        throw new TokenMismatchException;
    }
}

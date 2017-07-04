<?php

namespace App\Http\Middleware;

use Closure;
use \App\Service\AuthService;
class ResetPsswordMailAccess
{
    private $auth = null;
    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $hash = $request->hash;
        $model = $this->auth->checkResetPasswordMailHash($hash);
        if ($model) {
            return $next($request);
        }
        abort(404);

    }
}

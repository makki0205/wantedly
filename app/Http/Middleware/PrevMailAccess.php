<?php

namespace App\Http\Middleware;

use Closure;

class PrevMailAccess
{
    private $auth = null;
    public function __construct(\App\Service\AuthService $auth)
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
        $model = $this->auth->checkPrevMailHash($hash);
        if ($model) {
            return $next($request);
        }

        // redirectで独自のエラーページに飛ばせる(仮登録後24時間経っている 又は 仮登録自体していない)
        abort(404);
    }
}

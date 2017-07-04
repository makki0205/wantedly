<?php

namespace App\Http\Middleware;

use App\Service\UserDetailService;
use Closure;

class UserDetailmiddleware
{
    private $user_detail = null;
    public function __construct(UserDetailService $user_detail)
    {
        $this->user_detail = $user_detail;
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
        $nickname = $request->nickname;
        $model = $this->user_detail->findUserDetailFromNickname($nickname);
        if ($model) {
            return $next($request);
        }
        abort(404);

    }
}

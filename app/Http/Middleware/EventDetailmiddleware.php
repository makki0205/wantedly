<?php

namespace App\Http\Middleware;

use Closure;
use \App\Service\EventService;
class EventDetailMiddleware
{

    private $event = null;
    public function __construct(EventService $event)
    {
        $this->event = $event;
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
        $event_id = $request->event_id;
        $model = $this->event->getEvent($event_id);
        if ($model) {
            return $next($request);
        }

        // redirectで独自のエラーページに飛ばす(仮登録後24時間経っている 又は 仮登録自体していない)
        abort(404);
    }
}

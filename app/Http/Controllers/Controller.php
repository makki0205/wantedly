<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected function handleError(callable $func)
    {
        try {
            return $func();
        } catch (Exception $e) {
            return response()->json($this->error($e->getMessage()), $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json($this->error($e->getMessage()), $e->getStatusCode());
        }
    }
}

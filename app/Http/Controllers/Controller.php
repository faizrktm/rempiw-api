<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected function successResponse($code, $result)
    {
        return response()->json([
            'code' => $code,
            'result' => $result,
        ], $code);
    }

    protected function errorResponse($code, $message)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
        ], $code);
    }
}

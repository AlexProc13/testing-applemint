<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error()
    {
        return response()->json([
            'error' => 'Something went wrong.'
        ]);
    }
}

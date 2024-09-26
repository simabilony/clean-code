<?php

namespace App\Traits;

trait APIResponsesTrait
{
    public function respondOk($data)
    {
        return response()->json([
            'result' => 'success',
            'data' => $data,
        ], 200);
    }
}

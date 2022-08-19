<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiBaseController extends Controller
{
    public function successResponse($result = [], $message = '', $code = 200)
    {
        return response()->json([
            'data' => $result,
            'message' => $message,
            'code' => $code
        ], $code);
    }

    public function failResponse($message = '', $errorMessages = [], $code = 401)
    {
        $response = [
            'message' => $message,
            'code' => $code
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}

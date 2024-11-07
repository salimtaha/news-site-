<?php

if (!function_exists('apiResponse')) {
    function apiResponse($status, $message, $data = null)
    {
        $response = [
            'status' => $status,
            'message' => $message,
        ];
        if ($data) {
            $response['data'] = $data;
        }
        return response()->json($response, $status);
    }
}

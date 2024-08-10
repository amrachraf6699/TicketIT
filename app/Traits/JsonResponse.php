<?php

namespace App\Traits;

trait JsonResponse {
    public function ok($status, $message, $data = null) {
        $response =
            [
                'status_code' => $status,
                'message' => $message,
            ];
        if ($data) {
            $response['data'] = $data;
        }

        return response()->json($response, $status);
    }

    public function error($status, $message, $data = null) {
        $response =
            [
                'status_code' => $status,
                'message' => $message,
            ];
        if ($data) {
            $response['data'] = $data;
        }

        return response()->json($response, $status);
    }
}

<?php

namespace App\Trait;


use Illuminate\Http\JsonResponse;

trait ApiResponse
{

    /**
     * Api Response
     * @param string $message
     * @param int $status
     * @param array $headers
     * @return JsonResponse
     */
    public function success(string $message, int $status = 200, array $headers = []): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        return new JsonResponse($response, $status, $headers);
    }

    public function error(string $message, int $status = 500, array $headers = []): JsonResponse
    {
        $response =
            [
                "success" => false,
                'message' => $message
            ];

        return new JsonResponse($response, $status, $headers);
    }

}

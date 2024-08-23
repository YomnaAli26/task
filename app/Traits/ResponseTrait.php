<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;

trait ResponseTrait
{
    private array $response;

    public function getResponse($code = 200, $message = "success", $data = [], $errors = [], $settings = [], $paginator = null)
    {
        // Determine the result based on the status code
        $result = $code >= 200 && $code < 300 ? "success" : "error";

        // Prepare the response array
        $response = [
            'result' => $result,
            'code' => $code,
            'timestamp' => now()->toDateTimeString(),
            'message' => $message,
        ];

        // Include errors if they exist
        if (!empty($errors)) {
            $response['errors'] = $errors;
        }

        // Include data if provided
        if (!empty($data)) {
            $response['data'] = $data;
        }

        // Include settings if provided
        if (!empty($settings)) {
            $response['settings'] = $settings;
        }

        // Include pagination information if provided
        if ($paginator instanceof LengthAwarePaginator) {
            $response['pagination'] = [
                'totalItems' => $paginator->total(),
                'itemsPerPage' => $paginator->perPage(),
                'totalPages' => $paginator->lastPage(),
                'currentPage' => $paginator->currentPage(),
            ];
        }

        // Return the JSON response
        return response()->json($response, $code);
    }

}

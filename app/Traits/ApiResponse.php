<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait ApiResponse
{
    /**
     * Success response rest api.
     *
     * @param $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function successResponse($data, string $message = 'null', int $code = ResponseAlias::HTTP_OK): JsonResponse
    {
        return new JsonResponse([
            'status' => [
                'code'    => 0,
                'message' => $message
            ],
            'data' => $data
        ],$code);
    }

    /**
     * Error response rest api.
     *
     * @param null $message
     * @param int $code
     * @return JsonResponse
     */
    protected function errorResponse($message = null, int $code = ResponseAlias::HTTP_BAD_REQUEST): JsonResponse
    {
        return new JsonResponse([
            'status' => [
                'code'    => 1,
                'message' => ($message["resultDesc"] ?? $message) ?? null
            ],
            'data' => $message
        ],$code);
    }

    /**
     * Error response validator.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return JsonResponse
     */
    protected function formatValidationErrors(\Illuminate\Contracts\Validation\Validator $validator): JsonResponse
    {
        return new JsonResponse([
            'status' => [
                'code'    => 1,
                'message' => $validator->getMessageBag()
            ]
        ], 422);
    }
}

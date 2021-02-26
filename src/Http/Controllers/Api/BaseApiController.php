<?php

declare(strict_types=1);

namespace Tipoff\Support\Http\Controllers\Api;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Tipoff\Support\Http\Controllers\BaseController;

abstract class BaseApiController extends BaseController
{
    protected int $statusCode = SymfonyResponse::HTTP_OK;

    protected array $allowedRelationships = [];

    /**
     * Respond with success status and message.
     */
    public function respondSuccess(string $message = 'SUCCESS'): Response
    {
        return $this->statusCode(SymfonyResponse::HTTP_OK)->respond(['data' => ['message' => 'success']]);
    }

    /**
     * Respond with not found status and message.
     */
    public function respondNotFound(string $code = 'NOT_FOUND'): Response
    {
        return $this->statusCode(SymfonyResponse::HTTP_NOT_FOUND)->respondWithError($code);
    }

    /**
     * Respond with method not allowed status and message.
     */
    public function respondNotAllowed(string $code = 'NOT_ALLOWED'): Response
    {
        return $this->statusCode(SymfonyResponse::HTTP_METHOD_NOT_ALLOWED)->respondWithError($code);
    }

    /**
     * Respond with unprocessable entity status and message.
     */
    public function respondValidationError(string $code = 'VALIDATION_ERROR'): Response
    {
        return $this->statusCode(SymfonyResponse::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($code);
    }

    /**
     * Respond with unauthorized status and code.
     */
    public function respondUnauthorized(string $code = 'UNAUTHORIZED'): Response
    {
        return $this->statusCode(SymfonyResponse::HTTP_UNAUTHORIZED)->respondWithError($code);
    }

    /**
     * Set http status code.
     */
    public function statusCode(?int $statusCode = null): self
    {
        if (! empty($statusCode)) {
            $this->statusCode = $statusCode;
        }

        return $this;
    }

    /**
     * Generate response with specific data and headers.
     */
    public function respond(array $data, array $headers = []): Response
    {
        return response()->json($data, $this->statusCode, $headers);
    }

    /**
     * Return error response.
     */
    public function respondWithError(string $code): Response
    {
        return $this->respond([
            'errors' => [
                [
                    'status' => $this->statusCode(),
                    'code' => $code,
                    'title' => trans("errors.$code"),
                ],
            ],
        ]);
    }

    /**
     * Validate include variable (from get), and return it as array.
     */
    public function buildRelationships(string $include): array
    {
        if (empty($include)) {
            return [];
        }

        return array_intersect($this->allowedRelationships, explode(',', $include));
    }
}

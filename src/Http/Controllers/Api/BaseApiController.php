<?php

declare(strict_types=1);

namespace Tipoff\Support\Http\Controllers\Api;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Tipoff\Support\Http\Controllers\BaseController;

class BaseApiController extends BaseController
{
    /**
     * @var int
     */
    protected $statusCode = SymfonyResponse::HTTP_OK;

    /**
     * Respond with success status and message.
     *
     * @param string $message
     * @return \Illuminate\Http\Response
     */
    public function respondSuccess($message = 'SUCCESS')
    {
        return $this->statusCode(SymfonyResponse::HTTP_OK)->respond(['data' => ['message' => 'success']]);
    }

    /**
     * Respond with not found status and message.
     *
     * @param string $code
     * @return \Illuminate\Http\Response
     */
    public function respondNotFound($code = 'NOT_FOUND')
    {
        return $this->statusCode(SymfonyResponse::HTTP_NOT_FOUND)->respondWithError($code);
    }

    /**
     * Respond with method not allowed status and message.
     *
     * @param string $code
     * @return \Illuminate\Http\Response
     */
    public function respondNotAllowed($code = 'NOT_ALLOWED')
    {
        return $this->statusCode(SymfonyResponse::HTTP_METHOD_NOT_ALLOWED)->respondWithError($code);
    }

    /**
     * Respond with unprocessable entity status and message.
     * @param string $code
     * @return \Illuminate\Http\Response
     */
    public function respondValidationError($code = 'VALIDATION_ERROR')
    {
        return $this->statusCode(SymfonyResponse::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($code);
    }

    /**
     * Respond with unauthorized status and code.
     * @param string $code
     * @return \Illuminate\Http\Response
     */
    public function respondUnauthorized($code = 'UNAUTHORIZED')
    {
        return $this->statusCode(SymfonyResponse::HTTP_UNAUTHORIZED)->respondWithError($code);
    }

    /**
     * Set or get http status code.
     *
     * @param int|null $statusCode
     * @return int|$this
     */
    public function statusCode($statusCode = null)
    {
        if (! empty($statusCode)) {
            $this->statusCode = $statusCode;

            return $this;
        }

        return $this->statusCode;
    }

    /**
     * Generate response with specific data and headers.
     * @param array $data
     * @param void|array $headers
     * @return \Illuminate\Http\Response
     */
    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->statusCode(), $headers);
    }

    /**
     * Return error response.
     *
     * @param string $status HTTP status code
     * @param type $code Error code (check resources/lang/en/errors.php)
     * @return \Illuminate\Http\Response
     */
    public function respondWithError($code)
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
     * @param string $include
     * @return array
     */
    public function buildRelationships($include)
    {
        if (empty($include)) {
            return [];
        }

        return array_intersect($this->allowedRelationships, explode(',', $include));
    }
}

<?php

declare(strict_types=1);

namespace Tipoff\Support\Tests\Unit\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Tipoff\Support\Http\Controllers\Api\BaseApiController;
use Tipoff\Support\Tests\TestCase;

class BaseApiControllerTest extends TestCase
{
    /** @test  */
    public function success()
    {
        $controller = new class extends BaseApiController {
        };

        $result = $controller->respondSuccess();
        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertEquals(200, $result->status());
        $this->assertEquals('{"data":{"message":"success"}}', $result->content());
    }

    /** @test  */
    public function not_found()
    {
        $controller = new class extends BaseApiController {
        };

        $result = $controller->respondNotFound();
        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertEquals(404, $result->status());
        $this->assertEquals('{"errors":[{"status":{},"code":"NOT_FOUND","title":"errors.NOT_FOUND"}]}', $result->content());
    }

    /** @test  */
    public function not_allowed()
    {
        $controller = new class extends BaseApiController {
        };

        $result = $controller->respondNotAllowed();
        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertEquals(405, $result->status());
        $this->assertEquals('{"errors":[{"status":{},"code":"NOT_ALLOWED","title":"errors.NOT_ALLOWED"}]}', $result->content());
    }

    /** @test  */
    public function validation_error()
    {
        $controller = new class extends BaseApiController {
        };

        $result = $controller->respondValidationError();
        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertEquals(422, $result->status());
        $this->assertEquals('{"errors":[{"status":{},"code":"VALIDATION_ERROR","title":"errors.VALIDATION_ERROR"}]}', $result->content());
    }

    /** @test  */
    public function unauthorized()
    {
        $controller = new class extends BaseApiController {
        };

        $result = $controller->respondUnauthorized();
        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertEquals(401, $result->status());
        $this->assertEquals('{"errors":[{"status":{},"code":"UNAUTHORIZED","title":"errors.UNAUTHORIZED"}]}', $result->content());
    }

    /** @test */
    public function build_relationships_can_return_empty_array()
    {
        $controller = new class extends BaseApiController {
        };

        $result = $controller->buildRelationships('');
        $this->assertIsArray($result);
        $this->assertEmpty($result);

        $result = $controller->buildRelationships('comment,post');
        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }
}

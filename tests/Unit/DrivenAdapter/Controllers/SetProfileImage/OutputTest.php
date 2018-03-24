<?php

namespace PortsAndApaptersVariationsTests\Unit\DrivenAdapter\Controllers\SetProfileImage;

use PHPUnit\Framework\TestCase;
use PortsAndApaptersVariations\DrivenAdapter\Controllers\SetProfileImage\Output;
use Ramsey\Uuid\Uuid;

class OutputTest extends TestCase
{
    public function test_returns_json_response()
    {
        $output = new Output();

        $output->withImageId(Uuid::uuid4());

        $response = $output->buildResponse();

        $this->assertTrue($response->isOk(), "Expected a 200 response");
        $this->assertEquals("application/json", $response->headers->get("Content-Type"), "Expected JSON");
        $content = json_decode($response->getContent());
        $this->assertTrue(isset($content->image_id), "Expected an image_id in the response");
    }
}
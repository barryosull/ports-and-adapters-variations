<?php

namespace PortsAndApaptersVariationsTests\Unit\DriverAdapterImproved\Controllers\SetProfileImage;

use PHPUnit\Framework\TestCase;
use PortsAndApaptersVariations\DriverAdapterImproved\Controllers\SetProfileImage\ResponseFactory;
use PortsAndApaptersVariations\DriverAdapterImproved\Usecases\SetProfileImage\Output;
use Ramsey\Uuid\Uuid;

class ResponseFactoryTest extends TestCase
{
    public function test_returns_json_response()
    {
        $output = new Output(Uuid::uuid4());

        $responseFactory = new ResponseFactory();

        $response = $responseFactory->make($output);

        $this->assertTrue($response->isOk(), "Expected a 200 response");
        $this->assertEquals("application/json", $response->headers->get("Content-Type"), "Expected JSON");
        $content = json_decode($response->getContent());
        $this->assertTrue(isset($content->image_id), "Expected an image_id in the response");
    }
}
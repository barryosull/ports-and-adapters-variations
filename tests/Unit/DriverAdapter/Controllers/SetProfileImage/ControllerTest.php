<?php

namespace PortsAndApaptersVariationsTests\Unit\DriverAdapter\Controllers\SetProfileImage;

use PHPUnit\Framework\TestCase;
use PortsAndApaptersVariations\DriverAdapter\Controllers\SetProfileImage\Controller;
use PortsAndApaptersVariations\DriverAdapter\Usecases\SetProfileImage;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;

class ControllerTest extends TestCase
{
    public function test_parses_the_request_then_calls_the_usecase_then_returns_a_response()
    {
        $userId = Uuid::uuid4();

        $files = array(
            'profileImage' => array(
                'name' => 'test.jpg',
                'type' => 'image/jpeg',
                'size' => 542,
                'tmp_name' => __DIR__ . '/files/upload.png',
                'error' => 0
            )
        );

        $request = Request::create("", "POST", ['userId'=>$userId->toString()], [], $files);

        $usecase = $this->prophesize(SetProfileImage\Usecase::class);

        $userId = Uuid::fromString($userId);
        $image = new \SplFileInfo(__DIR__ . '/files/upload.png');
        $command = new SetProfileImage\Command($userId, $image);

        $usecase->handle($command)->willReturn(Uuid::uuid4());

        $controller = new Controller($usecase->reveal());

        $response = $controller->handle($request);

        $this->assertTrue($response->isOk(), "Expected a 200 response");
        $this->assertEquals("application/json", $response->headers->get("Content-Type"), "Expected JSON");
        $content = json_decode($response->getContent());
        $this->assertTrue(isset($content->image_id), "Expected an image_id in the response");
    }
}
<?php

namespace PortsAndApaptersVariationsTests\Acceptance;

use PHPUnit\Framework\TestCase;
use PortsAndApaptersVariations\Controllers\SetProfileImage;
use PortsAndApaptersVariations\DrivenAdapter;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;

abstract class SetProfileImageTest extends TestCase
{
    abstract protected function makeController(): SetProfileImage;

    public function test_storing_a_profile_image_returns_the_image_id()
    {
        $controller = $this->makeController();

        $userId = Uuid::uuid4()->toString();

        $files = array(
            'profileImage' => array(
                'name' => 'test.jpg',
                'type' => 'image/jpeg',
                'size' => 542,
                'tmp_name' => __DIR__ . '/files/upload.png',
                'error' => 0
            )
        );

        $request = Request::create("", "POST", ['userId'=>$userId], [], $files);

        $response = $controller->handle($request);

        $this->assertTrue($response->isOk(), "Expected a 200 response");
        $this->assertEquals("application/json", $response->headers->get("Content-Type"), "Expected JSON");
        $content = json_decode($response->getContent());
        $this->assertTrue(isset($content->image_id), "Expected an image_id in the response");
    }
}
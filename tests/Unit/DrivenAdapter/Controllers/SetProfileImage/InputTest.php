<?php

namespace PortsAndApaptersVariationsTests\Unit\DrivenAdapter\Controllers\SetProfileImage;

use PHPUnit\Framework\TestCase;
use PortsAndApaptersVariations\DrivenAdapter\Controllers\SetProfileImage\Input;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;

class InputTest extends TestCase
{
    public function test_converts_request_into_inputs()
    {
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

        $input = new Input($request);

        $this->assertEquals($userId, $input->userId()->toString());
        $this->assertEquals($files['profileImage']['tmp_name'], $input->image()->getRealPath());
    }
}
<?php

namespace PortsAndApaptersVariationsTests\Unit\DriverAdapterImproved\Controllers\SetProfileImage;

use PHPUnit\Framework\TestCase;
use PortsAndApaptersVariations\DriverAdapterImproved\Controllers\SetProfileImage\CommandFactory;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;

class CommandFactoryTest extends TestCase
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

        $commandFactory = new CommandFactory();

        $command = $commandFactory->make($request);

        $this->assertEquals($userId, $command->userId->toString());
        $this->assertEquals($files['profileImage']['tmp_name'], $command->image->getRealPath());
    }
}
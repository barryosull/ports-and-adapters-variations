<?php

namespace PortsAndApaptersVariationsTests\Acceptance;

use PortsAndApaptersVariations\Controllers\SetProfileImage;
use PortsAndApaptersVariations\DrivenAdapter;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class DrivenAdapterSetProfileImageTest extends TestCase
{
    public function test_storing_a_profile_image_returns_the_image_id()
    {
        $usecase = new DrivenAdapter\Usecases\SetProfileImage();

        $userId = Uuid::uuid4()->toString();
        $image = new \SplFileInfo(__DIR__ . '/../files/upload.png');

        $input = $this->prophesize(DrivenAdapter\Usecases\SetProfileImage\Input::class);
        $output = $this->prophesize(DrivenAdapter\Usecases\SetProfileImage\Output::class);

        $usecase->handle($input->reveal(), $output->reveal());

        $this->assertInstanceOf(UuidInterface::class, $imageId);
    }
}
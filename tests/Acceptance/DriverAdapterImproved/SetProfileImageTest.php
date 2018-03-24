<?php

namespace PortsAndApaptersVariationsTests\Acceptance\DriverAdapterImproved;

use PHPUnit\Framework\TestCase;
use PortsAndApaptersVariations\Domain\User;
use Ramsey\Uuid\Uuid;
use PortsAndApaptersVariations\DriverAdapterImproved\Usecases\SetProfileImage;

class SetProfileImageTest extends TestCase
{
    /**
     * @var ApplicationRunner
     */
    private $applicationRunner;

    public function setUp()
    {
        $this->applicationRunner = ApplicationRunner::make();
    }

    public function test_storing_a_profile_image_returns_the_image_id()
    {
        $userId = Uuid::uuid4();
        $image = new \SplFileInfo(__DIR__ . '/../files/upload.png');
        $user = new User($userId);

        $command = new SetProfileImage\Command($userId, $image);

        $this->applicationRunner
            ->givenUserExists($user)
            ->whenProfileImageIsSet($command)
            ->thenImageIdWasReturned()
            ->thenImageWasStored($image)
            ->thenUserWasStoredWithProfileImage($user);
    }
}
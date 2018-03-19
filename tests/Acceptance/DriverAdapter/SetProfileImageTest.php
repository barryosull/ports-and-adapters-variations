<?php

namespace PortsAndApaptersVariationsTests\Acceptance\DriverAdapter;

use PortsAndApaptersVariations\Domain\User;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

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

        $this->applicationRunner
            ->givenUserExists($user)
            ->whenProfileImageIsSet($userId, $image)
            ->thenImageIdWasReturned()
            ->thenImageWasStored($image)
            ->thenUserWasStoredWithProfileImage($user);
    }
}
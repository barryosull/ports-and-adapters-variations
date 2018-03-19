<?php

namespace PortsAndApaptersVariationsTests\Acceptance\DriverAdapter;

use PortsAndApaptersVariations\Domain\ImageRepository;
use PortsAndApaptersVariations\Domain\User;
use PortsAndApaptersVariations\Domain\UserRepository;
use PortsAndApaptersVariations\DriverAdapter\Usecases\SetProfileImage;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class SetProfileImageTest extends TestCase
{
    private $imageRepository;
    private $userRepository;

    public function setUp()
    {
        $this->imageRepository = $this->prophesize(ImageRepository::class);
        $this->userRepository = $this->prophesize(UserRepository::class);
    }

    public function test_storing_a_profile_image_returns_the_image_id()
    {
        // Inputs
        $userId = Uuid::uuid4();
        $image = new \SplFileInfo(__DIR__ . '/../files/upload.png');

        // Given
        $user = new User($userId);
        $this->givenUserExists($user);
        $usecase = new SetProfileImage\Usecase(
            $this->imageRepository->reveal(),
            $this->userRepository->reveal()
        );

        // When
        $command = new SetProfileImage\Command($userId, $image);
        $imageId = $usecase->handle($command);

        // Then
        $this->assertImageIdWasReturned($imageId);
        $this->assertImageWasStored($image);
        $this->assertUserWasStoredWithProfileImage($user);
    }

    private function assertImageIdWasReturned($imageId)
    {
        $this->assertInstanceOf(UuidInterface::class, $imageId);
    }

    private function givenUserExists(User $user)
    {
        $this->userRepository->find($user->userId)
            ->willReturn($user);
        $this->userRepository->store($user)
            ->shouldBeCalled();
    }

    private function assertImageWasStored($image)
    {
        $this->imageRepository->store(Argument::type(UuidInterface::class), $image)
            ->shouldHaveBeenCalled();
    }

    private function assertUserWasStoredWithProfileImage(User $user)
    {
        $this->assertInstanceOf(UuidInterface::class, $user->userId, "User profile image was never set");
        $this->userRepository->store($user)
            ->shouldHaveBeenCalled();
    }
}
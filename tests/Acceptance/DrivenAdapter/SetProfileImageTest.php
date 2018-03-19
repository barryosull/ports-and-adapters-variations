<?php

namespace PortsAndApaptersVariationsTests\Acceptance\DrivenAdapter;

use PortsAndApaptersVariations\Domain\ImageRepository;
use PortsAndApaptersVariations\Domain\User;
use PortsAndApaptersVariations\Domain\UserRepository;
use PortsAndApaptersVariations\DrivenAdapter\Usecases\SetProfileImage;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class SetProfileImageTest extends TestCase
{
    private $imageRepository;
    private $userRepository;
    private $inputAdapter;
    private $outputAdapter;

    public function setUp()
    {
        $this->imageRepository = $this->prophesize(ImageRepository::class);
        $this->userRepository = $this->prophesize(UserRepository::class);
        $this->inputAdapter = $this->prophesize(SetProfileImage\Input::class);
        $this->outputAdapter = $this->prophesize(SetProfileImage\Output::class);
    }

    public function test_storing_a_profile_image_returns_the_image_id()
    {
        // Inputs
        $userId = Uuid::uuid4();
        $image = new \SplFileInfo(__DIR__ . '/../files/upload.png');

        // Given
        $user = new User($userId);
        $this->givenUserExists($user);
        $this->givenUserIdAndImage($userId, $image);
        $usecase = new SetProfileImage\Usecase(
            $this->imageRepository->reveal(),
            $this->userRepository->reveal()
        );

        // When
        $usecase->handle($this->inputAdapter->reveal(), $this->outputAdapter->reveal());

        // Then
        $this->assertImageIdWasReturned();
        $this->assertImageWasStored($image);
        $this->assertUserWasStoredWithProfileImage($user);
    }

    private function givenUserExists(User $user)
    {
        $this->userRepository->find($user->userId)
            ->willReturn($user);
        $this->userRepository->store($user)
            ->shouldBeCalled();
    }

    private function givenUserIdAndImage(UuidInterface $userId, \SplFileInfo $image)
    {
        $this->inputAdapter->userId()->willReturn($userId);
        $this->inputAdapter->image()->willReturn($image);
    }

    private function assertImageIdWasReturned()
    {
        $this->outputAdapter->imageId(Argument::type(UuidInterface::class))
            ->shouldHaveBeenCalled();
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
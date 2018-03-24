<?php

namespace PortsAndApaptersVariationsTests\Acceptance\DriverAdapterImproved;

use PortsAndApaptersVariations\Domain\ImageRepository;
use PortsAndApaptersVariations\Domain\User;
use PortsAndApaptersVariations\Domain\UserRepository;
use PortsAndApaptersVariations\DriverAdapterImproved\Usecases\SetProfileImage;
use Prophecy\Argument;
use Ramsey\Uuid\UuidInterface;
use PHPUnit\Framework\TestCase;

class ApplicationRunner extends TestCase
{
    private $imageRepository;
    private $userRepository;

    /** @var SetProfileImage\Output */
    private $output;

    public static function make(): ApplicationRunner
    {
        $app = new ApplicationRunner();

        $app->imageRepository = $app->prophesize(ImageRepository::class);
        $app->userRepository = $app->prophesize(UserRepository::class);

        return $app;
    }

    public function givenUserExists(User $user): ApplicationRunner
    {
        $this->userRepository->find($user->userId)
            ->willReturn($user);
        $this->userRepository->store($user)
            ->shouldBeCalled();

        return $this;
    }

    public function whenProfileImageIsSet(SetProfileImage\Command $command): ApplicationRunner
    {
        $usecase = new SetProfileImage\Usecase(
            $this->imageRepository->reveal(),
            $this->userRepository->reveal()
        );

        $this->output = $usecase->handle($command);

        return $this;
    }

    public function thenImageIdWasReturned(): ApplicationRunner
    {
        $this->assertInstanceOf(UuidInterface::class, $this->output->imageId);

        return $this;
    }

    public function thenImageWasStored($image): ApplicationRunner
    {
        $this->imageRepository->store(Argument::type(UuidInterface::class), $image)
            ->shouldHaveBeenCalled();

        return $this;
    }

    public function thenUserWasStoredWithProfileImage(User $user): ApplicationRunner
    {
        $this->assertInstanceOf(UuidInterface::class, $user->userId, "User profile image was never set");
        $this->userRepository->store($user)
            ->shouldHaveBeenCalled();

        return $this;
    }
}
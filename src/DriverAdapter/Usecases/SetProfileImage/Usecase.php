<?php

namespace PortsAndApaptersVariations\DriverAdapter\Usecases\SetProfileImage;

use PortsAndApaptersVariations\Domain\ImageRepository;
use PortsAndApaptersVariations\Domain\UserRepository;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Usecase
{
    private $userRepository;
    private $imageRepository;

    public function __construct(ImageRepository $imageRepository, UserRepository $userRepository)
    {
        $this->imageRepository = $imageRepository;
        $this->userRepository = $userRepository;
    }

    public function handle(Command $command): UuidInterface
    {
        $imageId = Uuid::uuid4();
        $this->imageRepository->store($imageId, $command->image);

        $user = $this->userRepository->find($command->userId);
        $user->setProfileImage($imageId);
        $this->userRepository->store($user);

        return $imageId;
    }
}
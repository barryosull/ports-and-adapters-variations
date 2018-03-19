<?php

namespace PortsAndApaptersVariations\DrivenAdapter\Usecases\SetProfileImage;

use PortsAndApaptersVariations\Domain\ImageRepository;
use PortsAndApaptersVariations\Domain\UserRepository;
use Ramsey\Uuid\Uuid;

class Usecase
{
    private $userRepository;
    private $imageRepository;

    public function __construct(ImageRepository $imageRepository, UserRepository $userRepository)
    {
        $this->imageRepository = $imageRepository;
        $this->userRepository = $userRepository;
    }

    public function handle(Input $input, Output $output)
    {
        $imageId = Uuid::uuid4();
        $this->imageRepository->store($imageId, $input->image());

        $user = $this->userRepository->find($input->userId());
        $user->setProfileImage($imageId);
        $this->userRepository->store($user);

        $output->imageId($imageId);
    }
}


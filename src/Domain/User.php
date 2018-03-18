<?php

namespace PortsAndApaptersVariations\Domain;

use Ramsey\Uuid\UuidInterface;

// TODO: Flesh out with real logic
class User
{
    private $profileImageId = null;

    public static function find(UuidInterface $userId): User
    {
        return new User();
    }

    public static function save(User $user)
    {

    }

    public function setProfileImage(UuidInterface $imageId)
    {
        $this->profileImageId = $imageId;
    }
}
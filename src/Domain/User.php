<?php

namespace PortsAndApaptersVariations\Domain;

use Ramsey\Uuid\UuidInterface;

class User
{
    public $userId = null;
    public $profileImageId = null;

    public function __construct(UuidInterface $userId)
    {
        $this->userId = $userId;
    }

    public function setProfileImage(UuidInterface $imageId)
    {
        $this->profileImageId = $imageId;
    }
}
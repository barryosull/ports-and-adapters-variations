<?php

namespace PortsAndApaptersVariations\DriverAdapter\Usecases\SetProfileImage;

use Ramsey\Uuid\UuidInterface;
use SplFileInfo;

class Command
{
    public $userId;
    public $image;

    public function __construct(UuidInterface $userId, SplFileInfo $image)
    {
        $this->userId = $userId;
        $this->image = $image;
    }
}
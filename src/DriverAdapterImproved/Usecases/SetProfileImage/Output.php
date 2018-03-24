<?php

namespace PortsAndApaptersVariations\DriverAdapterImproved\Usecases\SetProfileImage;

use Ramsey\Uuid\UuidInterface;

class Output
{
    public $imageId;

    public function __construct(UuidInterface $imageId)
    {
        $this->imageId = $imageId;
    }
}
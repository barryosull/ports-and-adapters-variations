<?php

namespace PortsAndApaptersVariations\DrivenAdapter\Usecases\SetProfileImage;

use Ramsey\Uuid\UuidInterface;

interface Output
{
    public function imageId(UuidInterface $imageId);
}
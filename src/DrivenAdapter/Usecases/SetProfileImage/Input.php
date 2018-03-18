<?php

namespace PortsAndApaptersVariations\DrivenAdapter\Usecases\SetProfileImage;

use Ramsey\Uuid\UuidInterface;

interface Input
{
    public function userId(): UuidInterface;

    public function image(): \SplFileInfo;
}
<?php

namespace PortsAndApaptersVariations\DrivenAdapter\Controllers\SetProfileImage;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use PortsAndApaptersVariations\DrivenAdapter\Usecases;

class Input implements Usecases\SetProfileImage\Input
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function userId(): UuidInterface
    {
        return Uuid::fromString($this->request->get("userId"));
    }

    public function image(): \SplFileInfo
    {
        return $this->toSplFileInfo($this->request->files->get("profileImage"));
    }

    private function toSplFileInfo(UploadedFile $file): \SplFileInfo
    {
        return $file->getFileInfo();
    }
}
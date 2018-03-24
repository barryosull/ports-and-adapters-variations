<?php

namespace PortsAndApaptersVariations\DriverAdapterImproved\Controllers\SetProfileImage;

use PortsAndApaptersVariations\DriverAdapterImproved\Usecases\SetProfileImage\Command;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;

class CommandFactory
{
    public function make(Request $request): Command
    {
        $userId = Uuid::fromString($request->get("userId"));
        $image = $request->files->get("profileImage")->getFileInfo();

        return $command = new Command($userId, $image);
    }
}
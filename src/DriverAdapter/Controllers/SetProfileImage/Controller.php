<?php

namespace PortsAndApaptersVariations\DriverAdapter\Controllers\SetProfileImage;

use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use PortsAndApaptersVariations\DriverAdapter\Usecases\SetProfileImage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class Controller implements \PortsAndApaptersVariations\Controllers\SetProfileImage
{
    private $usecase;

    public function __construct(SetProfileImage\Usecase $usecase)
    {
        $this->usecase = $usecase;
    }

    public function handle(Request $request): Response
    {
        $userId = Uuid::fromString($request->get("userId"));
        $image = $request->files->get("profileImage")->getFileInfo();

        $command = new SetProfileImage\Command($userId, $image);
        $imageId = $this->usecase->handle($command);

        return JsonResponse::create(['image_id'=>$imageId->toString()]);
    }
}
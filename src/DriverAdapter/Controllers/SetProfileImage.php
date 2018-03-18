<?php

namespace PortsAndApaptersVariations\DriverAdapter\Controllers;

use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use PortsAndApaptersVariations\DriverAdapter\Usecases;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class SetProfileImage implements \PortsAndApaptersVariations\Controllers\SetProfileImage
{
    private $usecase;

    public function __construct(Usecases\SetProfileImage $usecase)
    {
        $this->usecase = $usecase;
    }

    public function handle(Request $request): Response
    {
        $userId = Uuid::fromString($request->get("userId"));
        $image = $request->files->get("profileImage")->getFileInfo();

        $imageId = $this->usecase->handle($userId, $image);

        return JsonResponse::create(['image_id'=>$imageId->toString()]);
    }
}
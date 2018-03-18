<?php

namespace PortsAndApaptersVariations\DrivenAdapter\Controllers\SetProfileImage;

use Ramsey\Uuid\UuidInterface;
use PortsAndApaptersVariations\DrivenAdapter\Usecases;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class Output implements Usecases\SetProfileImage\Output
{
    private $response;

    public function imageId(UuidInterface $imageId)
    {
        $this->response = JsonResponse::create(['image_id'=>$imageId->toString()]);
    }

    public function response(): Response
    {
        return $this->response;
    }
};
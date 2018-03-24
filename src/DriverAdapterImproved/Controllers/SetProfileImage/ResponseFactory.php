<?php

namespace PortsAndApaptersVariations\DriverAdapterImproved\Controllers\SetProfileImage;

use PortsAndApaptersVariations\DriverAdapterImproved\Usecases\SetProfileImage\Output;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResponseFactory
{
    public function make(Output $output): Response
    {
        return JsonResponse::create(['image_id'=>$output->imageId->toString()]);
    }
}
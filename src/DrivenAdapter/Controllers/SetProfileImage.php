<?php

namespace PortsAndApaptersVariations\DrivenAdapter\Controllers;

use Symfony\Component\HttpFoundation\Request;
use PortsAndApaptersVariations\DrivenAdapter\Usecases;
use Symfony\Component\HttpFoundation\Response;

class SetProfileImage implements \PortsAndApaptersVariations\Controllers\SetProfileImage
{
    private $usecase;

    public function __construct(Usecases\SetProfileImage $usecase)
    {
        $this->usecase = $usecase;
    }

    public function handle(Request $request): Response
    {
        $input = new SetProfileImage\Input($request);
        $output = new SetProfileImage\Output();

        $this->usecase->handle($input, $output);

        return $output->response();
    }
}
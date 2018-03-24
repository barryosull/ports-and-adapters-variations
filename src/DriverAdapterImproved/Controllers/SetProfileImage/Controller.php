<?php

namespace PortsAndApaptersVariations\DriverAdapterImproved\Controllers\SetProfileImage;

use PortsAndApaptersVariations\DriverAdapterImproved\Usecases\SetProfileImage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller
{
    private $usecase;
    private $commandFactory;
    private $responseFactory;

    public function __construct(
        SetProfileImage\Usecase $usecase,
        CommandFactory $commandFactory,
        ResponseFactory $responseFactory
    )
    {
        $this->usecase = $usecase;
        $this->commandFactory = $commandFactory;
        $this->responseFactory = $responseFactory;
    }

    public function handle(Request $request): Response
    {
        $command = $this->commandFactory->make($request);
        $output = $this->usecase->handle($command);

        return $this->responseFactory->make($output);
    }
}
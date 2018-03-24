<?php

namespace PortsAndApaptersVariationsTests\Unit\DriverAdapterImproved\Controllers\SetProfileImage;

use PHPUnit\Framework\TestCase;
use PortsAndApaptersVariations\DriverAdapterImproved\Controllers\SetProfileImage;
use PortsAndApaptersVariations\DriverAdapterImproved\Usecases\SetProfileImage\Command;
use PortsAndApaptersVariations\DriverAdapterImproved\Usecases\SetProfileImage\Output;
use PortsAndApaptersVariations\DriverAdapterImproved\Usecases\SetProfileImage\Usecase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ControllerTest extends TestCase
{
    public function test_calls_the_usecase()
    {
        $usecase = $this->prophesize(Usecase::class);
        $commandFactory = $this->prophesize(SetProfileImage\CommandFactory::class);
        $responseFactory = $this->prophesize(SetProfileImage\ResponseFactory::class);

        $request = $this->prophesize(Request::class)->reveal();

        $commandFactory->make($request)->willReturn(
            $command = $this->prophesize(Command::class)->reveal()
        );

        $usecase->handle($command)->willReturn(
            $output = $this->prophesize(Output::class)->reveal()
        );

        $responseFactory->make($output)->willReturn(
            $expectedResponse = $this->prophesize(Response::class)->reveal()
        );

        $controller = new SetProfileImage\Controller(
            $usecase->reveal(),
            $commandFactory->reveal(),
            $responseFactory->reveal()
        );

        $response = $controller->handle($request);

        $this->assertEquals($expectedResponse, $response);
    }
}
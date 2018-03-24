<?php

namespace PortsAndApaptersVariationsTests\Unit\DrivenAdapter\Controllers\SetProfileImage;

use PHPUnit\Framework\TestCase;
use PortsAndApaptersVariations\DrivenAdapter\Controllers\SetProfileImage;
use PortsAndApaptersVariations\DrivenAdapter\Usecases\SetProfileImage\Usecase;
use Symfony\Component\HttpFoundation\Response;

class ControllerTest extends TestCase
{
    public function test_calls_the_usecase()
    {
        $usecase = $this->prophesize(Usecase::class);
        $input = $this->prophesize(SetProfileImage\Input::class);
        $output = $this->prophesize(SetProfileImage\Output::class);

        $expectedResponse = $this->prophesize(Response::class)->reveal();

        $output->buildResponse()
            ->shouldBeCalled()
            ->willReturn($expectedResponse);

        $controller = new SetProfileImage\Controller($usecase->reveal(), $input->reveal(), $output->reveal());

        $response = $controller->handle();

        $this->assertEquals($expectedResponse, $response);
    }
}
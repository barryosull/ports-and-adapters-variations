<?php

namespace PortsAndApaptersVariations\DrivenAdapter\Controllers\SetProfileImage;

use PortsAndApaptersVariations\DrivenAdapter\Usecases\SetProfileImage\Usecase;
use Symfony\Component\HttpFoundation\Response;

class Controller
{
    private $usecase;
    private $input;
    private $output;

    public function __construct(Usecase $usecase, Input $input, Output $output)
    {
        $this->usecase = $usecase;
        $this->input = $input;
        $this->output = $output;
    }

    public function handle(): Response
    {
        $this->usecase->handle($this->input, $this->output);

        return $this->output->response();
    }
}
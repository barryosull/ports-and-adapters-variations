<?php

namespace PortsAndApaptersVariations\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface SetProfileImage
{
    public function handle(Request $request): Response;
}
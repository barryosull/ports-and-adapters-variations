<?php

namespace PortsAndApaptersVariationsTests\Acceptance;

use PortsAndApaptersVariations\Controllers\SetProfileImage;
use PortsAndApaptersVariations\DriverAdapter;

class DriverAdapterSetProfileImageTest extends SetProfileImageTest
{
    protected function makeController(): SetProfileImage
    {
        return new DriverAdapter\Controllers\SetProfileImage(
            new DriverAdapter\Usecases\SetProfileImage()
        );
    }
}
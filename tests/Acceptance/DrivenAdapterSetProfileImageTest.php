<?php

namespace PortsAndApaptersVariationsTests\Acceptance;

use PortsAndApaptersVariations\Controllers\SetProfileImage;
use PortsAndApaptersVariations\DrivenAdapter;

class DrivenAdapterSetProfileImageTest extends SetProfileImageTest
{
    protected function makeController(): SetProfileImage
    {
        return new DrivenAdapter\Controllers\SetProfileImage(
            new DrivenAdapter\Usecases\SetProfileImage()
        );
    }
}
<?php

namespace PortsAndApaptersVariations\DrivenAdapter\Usecases;

use League\Flysystem\Filesystem;
use PortsAndApaptersVariations\DrivenAdapter\Usecases\SetProfileImage\Input;
use PortsAndApaptersVariations\DrivenAdapter\Usecases\SetProfileImage\Output;
use Ramsey\Uuid\Uuid;
use League\Flysystem\Memory\MemoryAdapter;
use PortsAndApaptersVariations\Domain\User;

class SetProfileImage
{
    private $filesystem;

    public function __construct()
    {
        $adapter = new MemoryAdapter();
        $this->filesystem = new Filesystem($adapter);
    }

    public function handle(Input $input, Output $output)
    {
        $userId = $input->userId();
        $image = $input->image();

        $imageId = Uuid::uuid4();

        $filepath = "profle_image/{$imageId->toString()}.".$image->getExtension();
        $image_contents = file_get_contents($image->getRealPath());
        $this->filesystem->write($filepath, $image_contents);

        $user = User::find($userId);
        $user->setProfileImage($imageId);
        User::save($user);

        $output->imageId($imageId);
    }
}


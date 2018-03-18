<?php

namespace PortsAndApaptersVariations\DriverAdapter\Usecases;

use League\Flysystem\Filesystem;
use League\Flysystem\Memory\MemoryAdapter;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use SplFileInfo;
use PortsAndApaptersVariations\Domain\User;

class SetProfileImage
{
    private $filesystem;

    public function __construct()
    {
        $adapter = new MemoryAdapter();
        $this->filesystem = new Filesystem($adapter);
    }

    public function handle(UuidInterface $userId, SplFileInfo $image): UuidInterface
    {
        $imageId = Uuid::uuid4();

        $filepath = "profle_image/{$imageId->toString()}.".$image->getExtension();
        $image_contents = file_get_contents($image->getRealPath());
        $this->filesystem->write($filepath, $image_contents);

        $user = User::find($userId);
        $user->setProfileImage($imageId);
        User::save($user);

        return $imageId;
    }
}
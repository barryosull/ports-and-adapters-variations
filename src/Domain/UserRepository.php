<?php

namespace PortsAndApaptersVariations\Domain;

use Ramsey\Uuid\UuidInterface;

class UserRepository
{
    public function find(UuidInterface $userId): User
    {
        return new User();
    }

    public function store(User $user)
    {

    }
}
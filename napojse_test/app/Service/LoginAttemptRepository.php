<?php

namespace App\Service;

use App\Entity\LoginAttempt;

class LoginAttemptRepository extends AbstractRepository
{
    public function getEntityClassName(): string
    {
        return LoginAttempt::class;
    }
}
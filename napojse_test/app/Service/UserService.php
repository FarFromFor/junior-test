<?php

namespace App\Service;

use App\Entity\User;
use App\Form\UserFormData;
use Doctrine\ORM\EntityManagerInterface;
use Nette\Security\Passwords;

class UserService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private Passwords              $passwords,
    )
    {
    }

    public function save(UserFormData $userFormData): void
    {
        $user = new User();
        $user->setFullName($userFormData->fullName);
        $user->setEmail($userFormData->email);
        $user->setPassword($this->passwords->hash($userFormData->password));
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}

<?php declare(strict_types=1);

namespace App\Service;

abstract class AbstractRepository extends \Doctrine\ORM\EntityRepository
{

    public function __construct(
        \Doctrine\ORM\EntityManagerInterface $entityManager,
    )
    {
        parent::__construct($entityManager, $entityManager->getClassMetadata($this->getEntityClassName()));
    }

    abstract protected function getEntityClassName(): string;

    public function save(\App\Entity\AbstractEntity $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function delete(\App\Entity\AbstractEntity $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

}

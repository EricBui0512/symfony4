<?php

namespace App\Repository;

use App\Entity\ContextLevels;
use App\Repository\CustomizedServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ContextLevels|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContextLevels|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContextLevels[]    findAll()
 * @method ContextLevels[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContextLevelsRepository extends CustomizedServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ContextLevels::class);
    }

    /**
     * @param $contextLevelName
     * @return ContextLevels Returns  ContextLevels objects
     */
    public function getContextByName($contextLevelName) {
        $contextLevel = $this->entityRepo->findOneBy(
            ['name' =>$contextLevelName]
        );
        return $contextLevel;

    }

}

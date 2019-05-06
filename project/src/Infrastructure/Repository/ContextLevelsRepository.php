<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Context\ContextLevels;
use App\Domain\Entity\Context\ContextLevelsRepoInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 *Class ContextLevelsRepository
 * @package App\Infrastructure\Repository
 */
class ContextLevelsRepository implements ContextLevelsRepoInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ObjectRepository
     */
    private $objectRepository;

    /**
     * ArticleRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(ContextLevels::class);
    }


    /**
     * @param $contextLevelName
     * @return ContextLevels
     */
    public function getContextByName($contextLevelName): ContextLevels
    {
        $contextLevel = $this->objectRepository->findOneBy(
            ['name' =>$contextLevelName]
        );
        return $contextLevel;

    }

}

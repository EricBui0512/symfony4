<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Role\RoleCapabilities;
use App\Domain\Entity\Role\RoleCapabilitiesRepoInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class RoleCapabilitiesRepository
 * @package App\Infrastructure\Repository
 */
class RoleCapabilitiesRepository implements RoleCapabilitiesRepoInterface
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
        $this->objectRepository = $this->entityManager->getRepository(RoleCapabilities::class);
    }

    /**
     * @param $roleId
     * @param $contextLevelId
     * @param $capabilityId
     * @return bool
     */
    public function hasThisCapability($roleId, $contextLevelId, $capabilityId): bool
    {
        $roleCapabilities = $this->objectRepository->findOneBy(array(
                'role_id' => $roleId,
                'context_level_id' => $contextLevelId,
                'capability_id' => $capabilityId
        ) );

        return ($roleCapabilities != null) ? true : false;
    }


}

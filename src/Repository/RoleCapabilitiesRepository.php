<?php

namespace App\Repository;

use App\Entity\RoleCapabilities;
use App\Repository\CustomizedServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RoleCapabilities|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoleCapabilities|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoleCapabilities[]    findAll()
 * @method RoleCapabilities[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoleCapabilitiesRepository extends CustomizedServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RoleCapabilities::class);
    }


    /**
     * @param $roleId
     * @param $contextLevelId
     * @param $capabilityId
     * @return bool
     */
    public function hasThisCapability($roleId, $contextLevelId, $capabilityId) {
        $roleCapabilities = $this->entityRepo->findOneBy(
            ['role_id' => $roleId],
            ['context_level' => $contextLevelId],
            ['capability' => $capabilityId]
        );

        return ($roleCapabilities == null) ? true : false;
    }


}

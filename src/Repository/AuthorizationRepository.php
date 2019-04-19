<?php

namespace App\Repository;


use App\Utils\ConstantTerms;

class AuthorizationRepository extends ServiceEntityRepository implements CapabilityRepoInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Capabilities::class);
    }


    /**
     * @param $userId
     * @param $contextLevelName
     * @param $capabilityName
     * @param null $contextId
     * @return bool
     */
    public function hasThisCapability($userId, $contextLevelName,$capabilityName,  $contextId = Null)
    {
        $roleAssignments = new RoleAssignmentRepository();
        if ($contextLevelName == ConstantTerms::SYSTEM_ADMIN_CONTEXT && $contextId == null) {
            $contextId = 1;
        }


        $contextLevelRepository = new ContextLevelsRepository();
        $contextLevelId = $contextLevelRepository->getContextByName()->getId();

        $capabilityRepository = new CapabilitiesRepository();
        $capabilityId = $capabilityRepository->getCapabilityByName()->getId();

        $userRoles = $roleAssignments->getUserRoles($userId, $contextId);

        $roleCapabilitiesRepository = new RoleCapabilitiesRepository();

        foreach($userRoles as $userRole) {
            if($roleCapabilitiesRepository->hasThisCapability($userRole->getId(), $contextLevelId, $capabilityId)){
                return true;
            }
        }
        return false;
    }


}
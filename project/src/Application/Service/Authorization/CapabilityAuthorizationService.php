<?php

/**
 * Created by PhpStorm.
 * User: tuongbui
 * Date: 5/5/19
 * Time: 10:11 PM
 */

namespace App\Application\Service\Authorization;



use App\Domain\Entity\Capabilities\CapabilitiesRepoInterface;
use App\Domain\Entity\Context\ContextLevelsRepoInterface;
use App\Domain\Entity\Role\RoleAssignmentRepoInterface;
use App\Domain\Entity\Role\RoleCapabilitiesRepoInterface;
use App\Application\Utils\ConstantTerms;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class CapabilityAuthorizationService
 * @package App\Application\Service\Authorization
 */
class CapabilityAuthorizationService
{
    protected $contextLevelsRepo;
    protected $capabilitiesRepo;
    protected $roleCapabilitiesRepo;
    protected $roleAssignmentRepo;

    public function __construct(ContextLevelsRepoInterface $contextLevelsRepoInterface, CapabilitiesRepoInterface $capabilitiesRepoInterface,
                                  RoleCapabilitiesRepoInterface $roleCapabilitiesRepoInterface, RoleAssignmentRepoInterface $roleAssignmentRepoInterface  )
    {
        $this->contextLevelsRepo = $contextLevelsRepoInterface;
        $this->capabilitiesRepo = $capabilitiesRepoInterface;
        $this->roleCapabilitiesRepo = $roleCapabilitiesRepoInterface;
        $this->roleAssignmentRepo = $roleAssignmentRepoInterface;
    }


    /**
     * Note default is check system capability
     * @param $userId
     * @param $contextLevelName
     * @param $capabilityName
     * @param null $contextId
     * @return bool
     */
    public function hasThisCapability(int $userId, string $contextLevelName, string $capabilityName, int $contextId = null): bool
    {

        if ($contextLevelName == ConstantTerms::SYSTEM_ADMIN_CONTEXT && $contextId == null) {
            $contextId = 1;
        }

        // get context level entity
        $contextlevel = $this->contextLevelsRepo->getContextByName($contextLevelName);

        // get capability entity
        $capability = $this->capabilitiesRepo->getCapabilityByName($capabilityName);


        $userRoles = $this->roleAssignmentRepo->getUserRoles($userId, $contextId);

        foreach($userRoles as $userRole) {
            if($this->roleCapabilitiesRepo->hasThisCapability($userRole->getId(), $contextlevel->getId(), $capability->getId())){
                return true;
            }
        }
        return false;
    }

}
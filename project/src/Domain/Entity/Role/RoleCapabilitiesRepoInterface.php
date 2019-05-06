<?php
/**
 * Created by PhpStorm.
 * User: tuongbui
 * Date: 5/5/19
 * Time: 10:19 PM
 */

namespace App\Domain\Entity\Role;


interface RoleCapabilitiesRepoInterface
{
    /**
     * @param $roleId
     * @param $contextLevelId
     * @param $capabilityId
     * @return bool
     */
    public function hasThisCapability($roleId, $contextLevelId, $capabilityId): bool;

}
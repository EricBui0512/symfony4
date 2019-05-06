<?php
/**
 * Created by PhpStorm.
 * User: tuongbui
 * Date: 6/5/19
 * Time: 2:03 AM
 */

namespace App\Application\Service\Authorization;
use App\Application\Utils\ConstantTerms;

final class CapabilityGroupAdminService extends CapabilityAuthorizationService
{

    public function isCreateGroupCapability($userId) {
        return $this->hasThisCapability($userId, ConstantTerms::SYSTEM_ADMIN_CONTEXT,ConstantTerms::CREATE_GROUP);
    }

    public function isAssignUserToGroupCapability($userId, $groupId) {
        return ($this->hasThisCapability($userId, ConstantTerms::SYSTEM_ADMIN_CONTEXT, ConstantTerms::ASSIGN_USER_IN_GROUP)
            || $this->hasThisCapability($userId,ConstantTerms::GROUP_ADMIN_CONTEXT, ConstantTerms::ASSIGN_USER_IN_GROUP, $groupId));
    }

    public function isRemoveUserFromGroupCapability($userId, $groupId) {
        return ($this->hasThisCapability($userId, ConstantTerms::SYSTEM_ADMIN_CONTEXT, ConstantTerms::REMOVE_USER_FROM_GROUP)
            || $this->hasThisCapability($userId,ConstantTerms::GROUP_ADMIN_CONTEXT, ConstantTerms::REMOVE_USER_FROM_GROUP, $groupId));

    }


    public function isDeleteGroupCapability($userId, $groupId) {
        return ($this->hasThisCapability($userId, ConstantTerms::SYSTEM_ADMIN_CONTEXT, ConstantTerms::DELETE_GROUP)
            || $this->hasThisCapability($userId,ConstantTerms::GROUP_ADMIN_CONTEXT, ConstantTerms::DELETE_GROUP, $groupId));

    }

}
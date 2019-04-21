<?php


namespace App\Controller;


use App\Utils\ConstantTerms;
use App\Controller\CapabilityAuthorizationController;

class CapabilityGroupController extends CapabilityAuthorizationController
{



    public function isCreateGroupCapability($userId) {
        return $this->authorizationRepo->hasThisCapability($userId, ConstantTerms::SYSTEM_ADMIN_CONTEXT,ConstantTerms::CREATE_GROUP);
    }

    public function isAssignUserToGroupCapability($userId, $groupId) {
        return ($this->authorizationRepo->hasThisCapability($userId, ConstantTerms::SYSTEM_ADMIN_CONTEXT, ConstantTerms::ASSIGN_USER_IN_GROUP
            || $this->authorizationRepo->hasThisCapability($userId,ConstantTerms::GROUP_ADMIN_CONTEXT, ConstantTerms::ASSIGN_USER_IN_GROUP, $groupId)));
    }

    public function isRemoveUserFromGroupCapability($userId, $groupId) {
        return ($this->authorizationRepo->hasThisCapability($userId, ConstantTerms::SYSTEM_ADMIN_CONTEXT, ConstantTerms::REMOVE_USER_FROM_GROUP
            || $this->authorizationRepo->hasThisCapability($userId,ConstantTerms::GROUP_ADMIN_CONTEXT, ConstantTerms::REMOVE_USER_FROM_GROUP, $groupId)));

    }


    public function isDeleteGroupCapability($userId, $groupId) {
        return ($this->authorizationRepo->hasThisCapability($userId, ConstantTerms::SYSTEM_ADMIN_CONTEXT, ConstantTerms::DELETE_GROUP
            || $this->authorizationRepo->hasThisCapability($userId,ConstantTerms::GROUP_ADMIN_CONTEXT, ConstantTerms::DELETE_GROUP, $groupId)));

    }
}
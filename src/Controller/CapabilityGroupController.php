<?php


namespace App\Controller;

use App\Repository\Interfaces\AuthorizationRepoInterface;
use App\Utils\ConstantTerms;

class CapabilityGroupController
{
    private static $authorizationRepo;

    public function __construct(AuthorizationRepoInterface $authorizationRepoInterface)
    {
        self::$authorizationRepo = $authorizationRepoInterface;
    }



    public static function isCreateGroupCapability($userId) {
        return self::$authorizationRepo->hasThisCapability($userId, ConstantTerms::SYSTEM_ADMIN_CONTEXT,ConstantTerms::CREATE_GROUP);
    }

    public static function isAssignUserToGroupCapability($userId, $groupId) {
        return (self::$authorizationRepo->hasThisCapability($userId, ConstantTerms::SYSTEM_ADMIN_CONTEXT, ConstantTerms::ASSIGN_USER_IN_GROUP
            || self::$authorizationRepo->hasThisCapability($userId,ConstantTerms::GROUP_ADMIN_CONTEXT, ConstantTerms::ASSIGN_USER_IN_GROUP, $groupId)));
    }

    public static function isRemoveUserFromGroupCapablity($userId, $groupId) {
        return (self::$authorizationRepo->hasThisCapability($userId, ConstantTerms::SYSTEM_ADMIN_CONTEXT, ConstantTerms::REMOVE_USER_FROM_GROUP
            || self::$authorizationRepo->hasThisCapability($userId,ConstantTerms::GROUP_ADMIN_CONTEXT, ConstantTerms::REMOVE_USER_FROM_GROUP, $groupId)));

    }


    public static function isDeleteGroupCapablity($userId, $groupId) {
        return (self::$authorizationRepo->hasThisCapability($userId, ConstantTerms::SYSTEM_ADMIN_CONTEXT, ConstantTerms::DELETE_GROUP
            || self::$authorizationRepo->hasThisCapability($userId,ConstantTerms::GROUP_ADMIN_CONTEXT, ConstantTerms::DELETE_GROUP, $groupId)));

    }
}